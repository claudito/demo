<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

type UserListItem = {
    id: number;
    name: string;
    email: string;
    created_at: string;
};

defineProps<{
    users: UserListItem[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Usuarios',
        href: '/users',
    },
];
</script>

<template>
    <Head title="Usuarios" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="rounded-xl border border-sidebar-border/70 bg-background p-4 dark:border-sidebar-border">
                <h1 class="text-lg font-semibold">Listado de usuarios</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Usuarios registrados en el sistema.
                </p>
            </div>

            <div class="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <table class="w-full text-sm">
                    <thead class="bg-muted/40">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">ID</th>
                            <th class="px-4 py-3 text-left font-medium">Nombre</th>
                            <th class="px-4 py-3 text-left font-medium">Email</th>
                            <th class="px-4 py-3 text-left font-medium">Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="user in users"
                            :key="user.id"
                            class="border-t border-sidebar-border/60"
                        >
                            <td class="px-4 py-3">{{ user.id }}</td>
                            <td class="px-4 py-3">{{ user.name }}</td>
                            <td class="px-4 py-3">{{ user.email }}</td>
                            <td class="px-4 py-3">
                                {{
                                    new Date(user.created_at).toLocaleDateString(
                                        'es-PE',
                                        {
                                            year: 'numeric',
                                            month: '2-digit',
                                            day: '2-digit',
                                        },
                                    )
                                }}
                            </td>
                        </tr>
                        <tr v-if="users.length === 0">
                            <td class="px-4 py-4 text-muted-foreground" colspan="4">
                                No hay usuarios para mostrar.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
