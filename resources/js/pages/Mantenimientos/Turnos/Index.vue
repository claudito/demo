<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Turnos', href: '/mantenimientos/turnos' },
];

const fields = [
    { name: 'nombre', label: 'Nombre' },
    { name: 'hora_inicio', label: 'Hora inicio', type: 'time' as const },
    { name: 'hora_fin', label: 'Hora fin', type: 'time' as const },
    { name: 'estado', label: 'Activo', type: 'checkbox' as const },
];
</script>

<template>
    <Head title="Mantenimientos - Turnos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Turnos"
            description="Administra turnos para control de asistencia."
            entity-label="turno"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/turnos"
        />
    </AppLayout>
</template>
