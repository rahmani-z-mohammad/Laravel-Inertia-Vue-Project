<template>

<header class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-white w-full">
  <div class="container mx-auto">
    <nav class="p-4 flex items-center justify-between">
      <div class="text-lg">
        <Link :href="route('listing.index')"> Listing</Link>
      </div>
      <div v-if="user" class="flex items-center gap-4">
        <Link :href="route('notification.index')" class="text-gray-500 relative pr-2 py-2 text-lg">
            🔔
            <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
              {{ notificationCount }}
            </div>
          </Link>
        <Link :href="route('realtor.listing.index')" class="text-sm text-gray-500">{{ user.name }}</Link>
        <Link :href="route('realtor.listing.create')" class="btn-primary"> +New Listing</Link>
        <div>
          <Link :href="route('logout')" method="delete" as="button">Logout</Link>
        </div>
      </div>
      <div v-else class="flex items-center gap-3">
        <Link :href="route('user-account.create')">Create Account</Link>
        <Link :href="route('login')">Sign In</Link>
      </div>
    </nav>
  </div>
</header>

<main class="container mx-auto p-4 w-full">

  <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-600 dark:border-green-900 bg-green-50 dark:bg-green-900 p-2">
  {{ flashSuccess }}
  </div>
  
  <!-- slot render content, if no content, then render Defult -->
  <slot>Default</slot>
  
</main>
</template>

<script setup>
//with usePage function we can have access to all data that we share through the Inertia Laravel Middleware
  import {Link, usePage} from '@inertiajs/vue3';
  import { computed } from '@vue/reactivity';


  // page.props.flash.success
  const page = usePage()

  const flashSuccess = computed(
    () => page.props.flash.success
  )
  
  const user = computed(
    () => page.props.user
  )

  const notificationCount = computed(
  () => Math.min(page.props.user.notificationCount, 9),
  )
</script>