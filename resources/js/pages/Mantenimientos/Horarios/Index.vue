<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Horarios', href: '/mantenimientos/horarios' },
];

const fields = [
    { name: 'nombre', label: 'Nombre' },
    { name: 'hora_entrada', label: 'Hora entrada', type: 'time' as const },
    { name: 'hora_salida', label: 'Hora salida', type: 'time' as const },
    { name: 'tolerancia_minutos', label: 'Tolerancia (min)', type: 'number' as const },
    { name: 'estado', label: 'Activo', type: 'checkbox' as const },
];
</script>

<template>
    <Head title="Mantenimientos - Horarios" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Horarios"
            description="Gestiona horarios de ingreso y salida."
            entity-label="horario"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/horarios"
        />
    </AppLayout>
</template>
