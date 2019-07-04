<template>
    <div>
        <div class="row">
            <div class="col-xs-4">
                <div class="box box-info">
                    <form @submit.prevent="addRecord()">

                        <div class="box-header">
                            <div class="box-title">
                                Department Entry
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <input type="text" name="description" class="form-control" v-model="dept.description" placeholder="Department" autofocus autocomplete="off">
                                <span class="help-block"><strong class="text-danger">{{ errors.description == undefined ? '' : errors.description[0] }}</strong></span>
                            </div>

                            <div class="form-group has-feedback">
                                <input type="text" name="abbrev" class="form-control" v-model="dept.abbrev" placeholder="Abbreviation (Ex: Information Technnology: IT)" autocomplete="off">
                                <span class="help-block"><strong class="text-danger">{{ errors.abbrev == undefined ? '' : errors.abbrev[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button class="btn btn-primary btn-block btn-flat"><i class="fa fa-save"></i> {{ edit == false ? 'Save' : 'Update' }} Department</button>
                            <a href="#" role="button" @click="clearForm()" class="btn btn-default btn-block btn-flat"><i class="fa fa-eraser"></i> Clear Form</a>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-xs-8">
                <div class="box box-warning">
                    <div class="box-body" style="margin-bottom: 0px;">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">{{ pagination.message }}</div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group has-feedback">
                                    <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search Departments" v-model="keyword" v-on:keyup="getInfo()">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-condensed">
                            <thead class="thead-dark">
                                <tr role="row">
                                    <th width="10%">#</th>
                                    <th width="55%">Department</th>
                                    <th width="20%">Abbreviation</th>
                                    <th width="15%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(dept,index) in depts" v-bind:key="index">
                                    <td>{{ pagination.first_rec + index }}</td>
                                    <td>{{ dept.description }}</td>
                                    <td>{{ dept.abbrev }}</td>
                                    <td class="text-center">
                                        <button @click="editRecord(dept)" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
                                        <button @click="deleteRecord(dept.id)" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
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
            </div>
        </div>
        
        <div class="modal fade" id="input-form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{ dept_id == '' ? 'Create' : 'Edit' }} Depart</h4>
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
import { constants } from 'crypto';
    export default {
        mounted() {
            
        },
        data() {
            return {
                depts: [],
                dept: {
                    id: '',
                    description: '',
                    abbrev: '',
                },
                edit: false,
                dept_id: '',
                pagination: {},
                errors: {},
                keyword: ''
            }
        },
        created() {
            this.getInfo();
        },
        methods: {
            getInfo(page_url) {
                page_url = page_url || '/api/setup/departments/' + this.keyword
                
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        let vm = this;
                        this.depts = res.data;
                        vm.makePagination(res.next_page_url, res.prev_page_url, res.current_page, res.last_page, res.from, res.to, res.total);
                    });
            },
            makePagination(next_page_url, prev_page_url, current_page, last_page, from, to, total) {
                let msg = total > 0 ? 'Showing ' + from + ' of ' + to + ' of ' + total + ' entries' : 'No records to show';

                let pagination = {
                    next_page: next_page_url,
                    prev_page: prev_page_url,
                    curr_page: current_page,
                    last_page: last_page,
                    first_rec: from,
                    last_rec: to,
                    total_rec: total,
                    message: msg
                }

                this.pagination = pagination;
            },
            addRecord() {
                let mtd = '';
                if (this.edit === false) {
                    // Add
                    mtd = 'post';
                } else {
                    // Update
                    mtd = 'put';
                }

                fetch('/api/setup/departments', {
                    method: mtd,
                    body: JSON.stringify(this.dept),
                    headers: {
                        'content-type': 'application/json'
                    }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.errors = data.Errors;
                        if (data.Results != undefined) {
                            this.clearForm();
                            this.getInfo();
                            $('input[name="description"]').focus();
                        }
                    })
                    .catch(err => console.log(err));
            },
            editRecord(dept) {
                this.edit = true;
                this.dept.id = dept.id;
                this.dept_id = dept.id;
                this.dept.description = dept.description;
                this.dept.abbrev = dept.abbrev;
                $('input[name="description"]').focus();
            },
            deleteRecord(id) {
                if (confirm('Are You Sure?')) {
                    fetch(`/api/setup/departments/${id}`, {
                    method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.getInfo();
                    })
                    .catch(err => console.log(err));
                }
            },
            clearForm() {
                this.edit = false;
                this.errors = {};
                this.dept.id = null;
                this.dept_id = null;
                this.dept.description = '';
                this.dept.abbrev = '';
                $('input[name="description"]').focus();
            }
        }
    }
</script>