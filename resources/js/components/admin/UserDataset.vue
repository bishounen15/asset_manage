<template>
    <div>
        <div class="box box-warning">
            <div class="box-body">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ pagination.first_rec }} to {{ pagination.last_rec }} of {{ pagination.total_rec }} entries</div>
                    </div>
                    <div class="col-xs-6">
                        <button class="btn btn-md btn-info pull-right" data-toggle="modal" data-target="#input-form"><i class="fa fa-plus"></i> Add New User</button>
                    </div>
                </div>

                <table class="table table-bordered table-condensed">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Date Registered</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user,index) in users" v-bind:key="index">
                            <td>{{ pagination.first_rec + index }}</td>
                            <td>{{ user.user_id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.created_at }}</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="dataTables_paginate paging_simple_numbers pull-right">
                            <ul class="pagination">
                                <li v-bind:class="[{ disabled: !pagination.prev_page }]" class="paginate_button previous"><a href="#" @click="!!pagination.prev_page && getInfo(pagination.prev_page)">Previous</a></li>
                                <li class="paginate_button disabled" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Page {{ pagination.curr_page }} of {{ pagination.last_page }}</a></li>
                                <li v-bind:class="[{ disabled: !pagination.next_page }]" class="paginate_button next"><a href="#" @click="!!pagination.next_page && getInfo(pagination.next_page)">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="input-form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{ user_id == '' ? 'Create' : 'Edit' }} User</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            
        },
        data() {
            return {
                users: [],
                user: {
                    id: '',
                    user_id: '',
                    name: '',
                    email: '',
                    created_at: ''
                },
                user_id: '',
                pagination: {}
            }
        },
        created() {
            this.getInfo();
        },
        methods: {
            getInfo(page_url) {
                page_url = page_url || '/api/admin/users'
                
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        let vm = this;
                        this.users = res.data;
                        vm.makePagination(res.next_page_url, res.prev_page_url, res.current_page, res.last_page, res.from, res.to, res.total);
                    });
            },
            makePagination(next_page_url, prev_page_url, current_page, last_page, from, to, total) {
                let pagination = {
                    next_page: next_page_url,
                    prev_page: prev_page_url,
                    curr_page: current_page,
                    last_page: last_page,
                    first_rec: from,
                    last_rec: to,
                    total_rec: total
                }

                this.pagination = pagination;
            }
        }
    }
</script>