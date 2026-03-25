<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Periodos', href: '/mantenimientos/periodos' },
];

const fields = [
    { name: 'nombre', label: 'Nombre' },
    { name: 'fecha_inicio', label: 'Fecha inicio', type: 'date' as const },
    { name: 'fecha_fin', label: 'Fecha fin', type: 'date' as const },
    { name: 'cerrado', label: 'Cerrado', type: 'checkbox' as const },
    { name: 'estado', label: 'Activo', type: 'checkbox' as const },
];
</script>

<template>
    <Head title="Mantenimientos - Periodos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Periodos"
            description="Define periodos de control de asistencia."
            entity-label="periodo"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/periodos"
        />
    </AppLayout>
</template>
