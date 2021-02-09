<template>
    <dash-layout>
        <div id="home">
            <!-- Screen header -->
              <!-- breadcrumb -->
            <nav class="text-sm font-semibold mb-6" aria-label="Breadcrumb">
              <ol class="list-none p-0 inline-flex">
                <li class="flex items-center text-blue-500">
                  <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </jet-nav-link>
                  <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li class="flex items-center">
                    Decisions
                </li>
               
              </ol>
            </nav>
            <!-- breadcrumb end -->

            <!-- title and action buttons -->
            <div class="lg:flex justify-between items-center mb-6">
                <p class="text-2xl font-semibold mb-2 lg:mb-0"> Decisions list</p>
                <jet-button class="bg-blue-500 hover:bg-blue-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow" @click.native="createNew(form)">
                  + New
                </jet-button>
            </div>
            <!-- end title and action buttons -->

            <!-- End screen header -->

            <div class="flex flex-wrap -mx-3 mb-20">
                <!-- LOOP -->
                <div  v-for="decision in decisions"  :key=decision.id class="w-1/2 xl:w-1/4 px-3">
                    <!-- Card -->
                    <article class="overflow-hidden rounded-lg shadow-lg bg-white mb-5">
                        <header class=" items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="font-semibold text-2xl">                               
                                {{ decision.name }}                               
                            </h1>
                        <p class="mt-2">
                                    {{ decision.description }}
                                </p>
                        </header>
                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <button @click="edit(status)" class="bg-blue-500 hover:bg-blue-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Edit</button>
                            <button @click="deleteRow(status)" class="bg-red-500 hover:bg-red-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow">Delete</button>
                        </footer>
                    </article>
                    <!-- END Card -->
                </div>
                <!-- end loop -->
            </div>
        </div>

        <jet-dialog-modal :show="editMode || addMode" @close="editMode = false">
            <template #title>
                New status
            </template>

            <template #content>
                <div class="form-group">
                    <label for="name">Name</label>
                    <jet-input class="mt-1 block w-full" required id="name" v-model="form.name"/>
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <jet-input class="mt-1 block w-full" required id="description" v-model="form.description"/>
                </div>
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select  id="status_id" v-model='form.status_id' >                                   
                        <option v-for="status in statuses"  :key=status.id v-bind:value="status.id">{{status.name}}</option>
                    </select>
                </div>
            </template>
        
            <template #footer>
                <jet-button type="button" class="btn btn-default" @click.native="closeModal()">Close</jet-button>
                <jet-button type="submit" class="btn btn-primary" v-show="addMode" @click.native="save(form)">Save
                </jet-button>
                <jet-button type="submit" class="btn btn-primary" v-show="editMode" @click.native="update(form)">Update
                </jet-button>
            </template>

        </jet-dialog-modal><!-- /.modal -->  
        
    </dash-layout>
</template>

<script>
      import DashLayout from '@/Layouts/DashLayout'
      import Button from '../../Jetstream/Button.vue'
      import JetDialogModal from '@/Jetstream/DialogModal'
      import JetInput from '@/Jetstream/Input'
      import JetButton from '@/Jetstream/Button'
      import JetNavLink from '@/Jetstream/NavLink'

     export default {
        components: {
            DashLayout,
            Button,
            JetButton,
            JetInput,
            JetDialogModal,
            JetNavLink,
        },
        props: ['decisions', 'statuses'],
        data() {
            return {
                editMode: false,
                addMode : false,
                currentlyEditingStatus: false,
                selectedStatus : 1,
                form: {
                    name: null,
                    description: null,
                    status_id: null,
                },
            }
        },
        methods: {           
            closeModal: function () {
              
                this.reset();
                this.editMode=false;
                this.addMode = false;
            },
            reset: function () {
                this.form = {
                    name: null,
                    description: null,
                    status_id: null,
                }
            },
            save: function (data) {
                this.$inertia.post('/decisions', data);
                this.reset();               
                this.addMode = false;
            },
            createNew: function(data)
            {
                this.reset();
                this.addMode = true;
            },
            edit: function (data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
            },
            update: function (data) {
                if (!confirm('Sure')) return;
                data._method = 'PUT';
                this.$inertia.post('/decisions/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            deleteRow: function (data) {
                if (!confirm('Sure')) return;
                data._method = 'DELETE';
                this.$inertia.post('/decisions/' + data.id, data)
                this.reset();
                this.closeModal();
            }
        }
     }
    console.log('Decisions.vue mounted');
</script>