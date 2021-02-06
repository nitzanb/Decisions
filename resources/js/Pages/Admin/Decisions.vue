<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Decisions
            </h2>
             
        </template>

        <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto">
                    <h3 class="px-6 py-4 float-left"> Decisions list</h3>
                    <jet-button type="submit" class="btn btn-primary float-right mx-6 my-4"  @click.native="createNew(form)">+ New</jet-button>
                </div>
            </div>
        </div>

        <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                <!-- LOOP -->
                <div  v-for="decision in decisions"  :key=decision.id class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <!-- Card -->
                    <article class="overflow-hidden rounded-lg shadow-lg bg-white">
                        <header class=" items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">                               
                                {{ decision.name }}                               
                            </h1>
                            <p class="mt-2 text-sm">
                                    {{ decision.description }}
                            </p>
                        </header>
                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <button @click="edit(status)" class="inline-flex items-center justify-center px-2 py-1 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Edit</button>
                            <button @click="deleteRow(status)" class="inline-flex items-center justify-center px-2 py-1 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-red-200 hover:bg-indigo-50">Delete</button>
                        </footer>
                    </article>
                    <!-- END Card -->
                </div>
                <!--END Loop-->
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
                                    <option value="null" selected>Select status</option>
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

    

  
        
    </app-layout>
</template>
<script>
      import AppLayout from '@/Layouts/AppLayout'
      import Button from '../../Jetstream/Button.vue'
      import JetDialogModal from '@/Jetstream/DialogModal'
      import JetInput from '@/Jetstream/Input'
      import JetButton from '@/Jetstream/Button'

     export default {
        components: {
            AppLayout,
            Button,
            JetButton,
            JetInput,
            JetDialogModal,
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
    console.log('hi nitzan, I am working');
</script>