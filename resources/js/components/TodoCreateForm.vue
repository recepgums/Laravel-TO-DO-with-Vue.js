<template>
    <div class="container">
        <form >
            <textarea v-model="content" rows="5" class="form-control" placeholder="Todo..."></textarea>
            <br>
            <button class="form-control col-3 float-right btn btn-primary" @click="createTodoFunction">Create</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "TodoCreateForm",
        data(){
            return {
                content:null
            }
        },
        methods:{
            createTodoFunction(e){
                e.preventDefault()
                axios.
                    post('/todo',{
                        content:this.content
                }).then(resp=>{
                    this.$notify({
                        title: 'Success',
                        message: resp.data.message,
                        type: 'success'
                    });
                }).catch(error=> {
                    this.$notify({
                        title: 'Error',
                        message: error.data.message,
                        type: 'error'
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>
