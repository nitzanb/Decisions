<template>

  <div class="leading-normal tracking-normal" id="main-body">
     <jet-banner />
    <div class="flex flex-wrap">

      <Sidebar />

      <div class="w-full bg-gray-100 pl-0 lg:pl-64 min-h-screen" :class="sideBarOpen ? 'overlay' : ''" id="main-content">

        <Navbar />

        <div class="p-6 bg-gray-100 mb-20">
          <slot></slot>
        </div>
<!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        <Footer />

      </div>
    </div>
  </div>
</template>

<script>

import Sidebar from '@/components/Sidebar'
import Navbar from '@/components/Navbar'
import Footer from '@/components/Footer'
 import JetBanner from '@/Jetstream/Banner'
export default {
  name: 'Dashboard',
  
  components: {
    Sidebar,
    Navbar,
    Footer,
    JetBanner,
  }, 
  data() {
        return {
            sideBarOpen : false,
        }
    }

}


/**
 * Layout taken from: https://github.com/Murked/vue-tailwind-admin/
 */
</script>