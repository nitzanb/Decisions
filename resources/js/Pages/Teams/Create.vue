<template>
    <dash-layout>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <create-team-form />
            </div>
        </div>
    </dash-layout>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout'
    import CreateTeamForm from './CreateTeamForm'

    export default {
        components: {
            DashLayout,
            CreateTeamForm,
        },
    }
</script>
