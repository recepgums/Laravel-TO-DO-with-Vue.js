<template>
    <div class="container">
        <input type="text" v-model="search" @keypress="searchTodo()" class="form-control col-8 text-center" placeholder="Arama...">
        <el-table
            :data="tableData"
            style="width: 100%">

            <el-table-column
                label="Done"
                width="75"
            >
                <template slot-scope="scope">
                    <el-checkbox v-model="scope.row.is_done"></el-checkbox>
                </template>
            </el-table-column>

            <el-table-column
                label="Content">
                <template slot-scope="scope">
                    <div slot="reference" class="name-wrapper">
                        <el-tag size="medium"  :type="scope.row.is_done ? 'success' : ''">{{ scope.row.content }}</el-tag>
                    </div>
                </template>
            </el-table-column>

            <el-table-column
                label="Operations"
                width="200"
            >
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="handleEdit(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="handleDelete(scope.$index, scope.row)">Delete
                    </el-button>
                </template>
            </el-table-column>

        </el-table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tableData: [],
                search:null

            }
        },
        methods: {
            handleEdit(index, row) {
                window.location = window.location.origin + '/todo/' +  row.id + '/edit';
            },
            handleDelete(index, row) {
                console.log(index, row);
                this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    axios
                    .delete('todo/'+row.id)
                    .then(resp=>{
                        this.getTodoList();
                        this.$message({
                            type: 'success',
                            message: 'Delete completed'
                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'We couldnt delete'
                        });
                    });

                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: 'Delete canceled'
                    });
                });
            },
            getTodoList() {
                axios
                    .get('/todo')
                    .then(response => {
                        this.tableData = response.data.data.map(q => {
                            return {
                                is_done: q.done_at == null ? true : false,
                                content: q.content,
                                id: q.id,
                            }
                        })
                    })
            },
            searchTodo(){
                axios
                    .get('/todo',{
                        params: {
                            search: this.search
                        }
                    })
                    .then(response => {
                        this.tableData = response.data.data.map(q => {
                            return {
                                is_done: q.done_at == null ? true : false,
                                content: q.content,
                                id: q.id,
                            }
                        })
                    })
            }
        },
        mounted() {
            this.getTodoList()
        }
    }
</script>
