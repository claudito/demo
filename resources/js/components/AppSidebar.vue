<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BookOpen, ChevronDown, FolderGit2, LayoutGrid, Users, Wrench } from 'lucide-vue-next';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Usuarios',
        href: '/users',
        icon: Users,
    },
];

const maintenanceItems: NavItem[] = [
    { title: 'Empleados', href: '/mantenimientos/empleados' },
    { title: 'Feriados', href: '/mantenimientos/feriados' },
    { title: 'Horarios', href: '/mantenimientos/horarios' },
    { title: 'Turnos', href: '/mantenimientos/turnos' },
    { title: 'Periodos', href: '/mantenimientos/periodos' },
    { title: 'Tipos de Boletas', href: '/mantenimientos/tipos-boletas' },
    { title: 'Ubigeos', href: '/mantenimientos/ubigeos' },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: FolderGit2,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];

const { isCurrentOrParentUrl, isCurrentUrl } = useCurrentUrl();

const isMantenimientosOpen = computed(() =>
    maintenanceItems.some((item) => isCurrentOrParentUrl(item.href)),
);
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />

            <SidebarGroup class="px-2 py-0">
                <SidebarGroupLabel>Modulos</SidebarGroupLabel>
                <SidebarMenu>
                    <Collapsible :default-open="isMantenimientosOpen" class="group/collapsible">
                        <SidebarMenuItem>
                            <CollapsibleTrigger as-child>
                                <SidebarMenuButton :is-active="isMantenimientosOpen">
                                    <Wrench />
                                    <span>Mantenimientos</span>
                                    <ChevronDown
                                        class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-180"
                                    />
                                </SidebarMenuButton>
                            </CollapsibleTrigger>

                            <CollapsibleContent>
                                <SidebarMenuSub>
                                    <SidebarMenuSubItem
                                        v-for="item in maintenanceItems"
                                        :key="item.title"
                                    >
                                        <SidebarMenuSubButton as-child :is-active="isCurrentUrl(item.href)">
                                            <Link :href="item.href">
                                                <span>{{ item.title }}</span>
                                            </Link>
                                        </SidebarMenuSubButton>
                                    </SidebarMenuSubItem>
                                </SidebarMenuSub>
                            </CollapsibleContent>
                        </SidebarMenuItem>
                    </Collapsible>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
