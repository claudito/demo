<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

type FieldOption = {
    label: string;
    value: string | number;
};

type FieldConfig = {
    name: string;
    label: string;
    type?: 'text' | 'number' | 'date' | 'time' | 'textarea' | 'checkbox';
    placeholder?: string;
    table?: boolean;
    options?: FieldOption[];
};

const props = defineProps<{
    title: string;
    description: string;
    entityLabel: string;
    records: Record<string, any>[];
    fields: FieldConfig[];
    basePath: string;
}>();

const isDialogOpen = ref(false);
const editingId = ref<number | null>(null);
const mode = ref<'create' | 'edit'>('create');

const form = useForm<Record<string, any>>({});

const tableFields = computed(() => props.fields.filter((field) => field.table !== false));

function defaultValueForField(field: FieldConfig) {
    if (field.type === 'checkbox') return true;
    if (field.type === 'number') return 0;
    return '';
}

function initializeForm(record?: Record<string, any>) {
    props.fields.forEach((field) => {
        const value = record?.[field.name];
        form[field.name] = value ?? defaultValueForField(field);
    });
}

function openCreateDialog() {
    mode.value = 'create';
    editingId.value = null;
    initializeForm();
    form.clearErrors();
    isDialogOpen.value = true;
}

function openEditDialog(record: Record<string, any>) {
    mode.value = 'edit';
    editingId.value = Number(record.id);
    initializeForm(record);
    form.clearErrors();
    isDialogOpen.value = true;
}

function closeDialog() {
    isDialogOpen.value = false;
}

function submit() {
    if (mode.value === 'create') {
        form.post(props.basePath, {
            preserveScroll: true,
            onSuccess: () => closeDialog(),
        });
        return;
    }

    form.put(`${props.basePath}/${editingId.value}`, {
        preserveScroll: true,
        onSuccess: () => closeDialog(),
    });
}

function removeRecord(id: number) {
    if (!window.confirm(`¿Deseas eliminar este registro de ${props.entityLabel}?`)) {
        return;
    }

    router.delete(`${props.basePath}/${id}`, {
        preserveScroll: true,
    });
}

function formatCell(record: Record<string, any>, field: FieldConfig) {
    const value = record[field.name];

    if (field.type === 'checkbox') {
        return value ? 'Sí' : 'No';
    }

    return value ?? '-';
}
</script>

<template>
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="rounded-xl border border-sidebar-border/70 bg-background p-4 dark:border-sidebar-border">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-lg font-semibold">{{ title }}</h1>
                    <p class="mt-1 text-sm text-muted-foreground">{{ description }}</p>
                </div>
                <Button @click="openCreateDialog">Nuevo</Button>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <table class="w-full text-sm">
                <thead class="bg-muted/40">
                    <tr>
                        <th
                            v-for="field in tableFields"
                            :key="field.name"
                            class="px-4 py-3 text-left font-medium"
                        >
                            {{ field.label }}
                        </th>
                        <th class="px-4 py-3 text-left font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="record in records"
                        :key="record.id"
                        class="border-t border-sidebar-border/60"
                    >
                        <td
                            v-for="field in tableFields"
                            :key="`${record.id}-${field.name}`"
                            class="px-4 py-3"
                        >
                            {{ formatCell(record, field) }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <Button variant="outline" size="sm" @click="openEditDialog(record)">Editar</Button>
                                <Button variant="destructive" size="sm" @click="removeRecord(record.id)">
                                    Eliminar
                                </Button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="records.length === 0">
                        <td :colspan="tableFields.length + 1" class="px-4 py-4 text-muted-foreground">
                            No hay registros para mostrar.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Dialog :open="isDialogOpen" @update:open="isDialogOpen = $event">
            <DialogContent class="sm:max-w-2xl">
                <DialogHeader>
                    <DialogTitle>
                        {{ mode === 'create' ? `Nuevo ${entityLabel}` : `Editar ${entityLabel}` }}
                    </DialogTitle>
                    <DialogDescription>
                        Completa los campos del mantenimiento.
                    </DialogDescription>
                </DialogHeader>

                <div class="grid gap-4 py-2 md:grid-cols-2">
                    <div v-for="field in fields" :key="field.name" class="grid gap-2">
                        <label class="text-sm font-medium">{{ field.label }}</label>

                        <textarea
                            v-if="field.type === 'textarea'"
                            v-model="form[field.name]"
                            :placeholder="field.placeholder"
                            class="min-h-[90px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm outline-none"
                        />

                        <div v-else-if="field.type === 'checkbox'" class="flex h-9 items-center">
                            <input
                                v-model="form[field.name]"
                                type="checkbox"
                                class="h-4 w-4 rounded border-input"
                            >
                        </div>

                        <Input
                            v-else
                            v-model="form[field.name]"
                            :type="field.type ?? 'text'"
                            :placeholder="field.placeholder"
                        />

                        <p v-if="form.errors[field.name]" class="text-xs text-destructive">
                            {{ form.errors[field.name] }}
                        </p>
                    </div>
                </div>

                <DialogFooter>
                    <Button variant="outline" @click="closeDialog">Cancelar</Button>
                    <Button :disabled="form.processing" @click="submit">
                        {{ mode === 'create' ? 'Guardar' : 'Actualizar' }}
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </div>
</template>
