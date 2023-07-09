<template>

    <Head title="Todo" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="w-full">
                            <input
                                class="outline-none rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white"
                                placeholder="Add a task"  v-model="form.content">
                            <button class="px-4 hover:bg-blue-900 hover:transition-all rounded-r-lg bg-blue-600  text-white font-bold p-4 uppercase border-blue-600 border-t border-b border-r" @click="submit" >
                                Add
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-row align-center justify-between mx-4 p-4 border-b border-gray-200" v-for="todo in todos" :key="todo.id">
                        
                        <div class="align-middle">
                            <input type="checkbox" v-if="todo.is_done" @click="updateStatus(todo)" checked>
                            <input type="checkbox" v-else @click="updateStatus(todo)">
                        </div>     

                        <p class="w-full mx-4" v-bind:class = "(todo.is_done)?'line-through':''">{{ todo.content }}</p>

                        <!-- <input type="text" class="mx-4 outline-none w-full border-t-0 border-l-0 border-r-0 text-gray-800 border-gray-200 bg-white"> -->

                        <button class="px-4 hover:bg-yellow-900 hover:transition-all rounded-l-lg bg-yellow-600  text-white font-bold p-4 uppercase">
                            Edit
                        </button>

                        <button @click="deleteTask(todo)" class="px-4 hover:bg-red-900 hover:transition-all rounded-r-lg bg-red-600  text-white font-bold p-4 uppercase">
                            Delete
                        </button>
                            
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia';
    import { reactive } from 'vue';

    export default {
        props: {
            todos: Object
        },

        components: {
            BreezeAuthenticatedLayout,
            Head,
        },

        setup(){
            const form = reactive({
                content:null
            });

            function submit(){
                if(form.content != null){
                    Inertia.post('/todos', form);
                    form.content = null;
                }
            }

            function updateStatus(todo){
                Inertia.put('todos/'+todo.id+'/update');
            }

            function deleteTask(todo){
                Inertia.delete('todos/'+todo.id)
            }

            return {
                form,
                submit,
                updateStatus,
                deleteTask
            }
        }
    }
</script>
