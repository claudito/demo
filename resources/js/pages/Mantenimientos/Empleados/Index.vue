<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Empleados', href: '/mantenimientos/empleados' },
];

const fields = [
    { name: 'codigo', label: 'Código', placeholder: 'EMP001' },
    { name: 'nombres', label: 'Nombres' },
    { name: 'apellidos', label: 'Apellidos' },
    { name: 'cargo', label: 'Cargo' },
    { name: 'condicion_laboral', label: 'Condición laboral' },
    { name: 'estado', label: 'Activo', type: 'checkbox' as const },
];
</script>

<template>
    <Head title="Mantenimientos - Empleados" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Empleados"
            description="Gestiona empleados para el módulo de asistencias."
            entity-label="empleado"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/empleados"
        />
    </AppLayout>
</template>
