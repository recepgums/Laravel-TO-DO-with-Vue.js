<template>
    <div class="container">
        <form >
            <textarea v-model="content" rows="5" class="form-control" placeholder="Todo..."></textarea>
            <br>
            <button class="form-control col-3 float-right btn btn-primary" @click="updateTodoFunction">Update</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "TodoEditForm",
        props:['id'],
        data() {
            return {
                content:null
            }
        },
        methods:{
            getDataById(){
                axios
                .get('/todo/'+this.id)
                .then(resp => {
                    console.log(resp);
                  this.content = resp.data.content
                })
            },
            updateTodoFunction(e){
                e.preventDefault();
                axios
                .patch('/todo/'+this.id ,{
                    content:this.content
                })
                .then(resp => {
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
        },
        mounted() {
            this.getDataById()
        }
    }
</script>

<style scoped>

</style>
