<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MantenimientoCrudPage from '@/pages/Mantenimientos/components/MantenimientoCrudPage.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ records: Record<string, any>[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Mantenimientos', href: '/mantenimientos/empleados' },
    { title: 'Ubigeos', href: '/mantenimientos/ubigeos' },
];

const fields = [
    { name: 'id', label: 'Codigo', placeholder: '010101' },
    { name: 'departement', label: 'Departamento' },
    { name: 'province', label: 'Provincia' },
    { name: 'district', label: 'Distrito' },
    { name: 'region', label: 'Region' },
    { name: 'zone', label: 'Zona' },
    { name: 'zip_code', label: 'Zip Code' },
];
</script>

<template>
    <Head title="Mantenimientos - Ubigeos" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <MantenimientoCrudPage
            title="Mantenimiento de Ubigeos"
            description="Administra la tabla de ubigeos existente."
            entity-label="ubigeo"
            :records="records"
            :fields="fields"
            base-path="/mantenimientos/ubigeos"
        />
    </AppLayout>
</template>