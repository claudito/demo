<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Tipos de Boletas', href: '/mantenimientos/tipos-boletas' },
];

const fields = [
    { name: 'nombre', label: 'Nombre' },
    { name: 'descripcion', label: 'Descripción', type: 'textarea' as const },
    { name: 'estado', label: 'Activo', type: 'checkbox' as const },
];
</script>

<template>
    <Head title="Mantenimientos - Tipos de Boletas" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Tipos de Boletas"
            description="Configura tipos de boletas del sistema."
            entity-label="tipo de boleta"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/tipos-boletas"
        />
    </AppLayout>
</template>
