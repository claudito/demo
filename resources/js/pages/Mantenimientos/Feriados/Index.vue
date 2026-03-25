<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Feriados', href: '/mantenimientos/feriados' },
];

const fields = [
    { name: 'nombre', label: 'Nombre' },
    { name: 'fecha', label: 'Fecha', type: 'date' as const },
    { name: 'es_recuperable', label: 'Recuperable', type: 'checkbox' as const },
    { name: 'estado', label: 'Activo', type: 'checkbox' as const },
];
</script>

<template>
    <Head title="Mantenimientos - Feriados" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Feriados"
            description="Administra días feriados oficiales."
            entity-label="feriado"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/feriados"
        />
    </AppLayout>
</template>
