<template>
    <dash-layout>
        

         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   Hello Me
                </div>
            </div>
        </div>


        
    </dash-layout>
</template>
<script>
      import DashLayout from '@/Layouts/DashLayout'

     export default {
        components: {
            DashLayout,
        },
        props: {
        user: Object,
        },
     }
    console.log('hi nitzan, I am working');
</script>