<template>
    <div>
        <div class="row">
            <div class="col-xs-4">
                <div class="box box-info">
                    <form @submit.prevent="addRecord()">

                        <div class="box-header">
                            <div class="box-title">
                                {{ general.title }} Entry
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <input type="text" name="description" class="form-control" v-model="site.description" v-bind:placeholder="general.title" autofocus autocomplete="off">
                                <span class="help-block"><strong class="text-danger">{{ errors.description == undefined ? '' : errors.description[0] }}</strong></span>
                            </div>

                            <div class="form-group has-feedback">
                                <select name="parent_id" class="form-control" v-model="site.parent_id" placeholder="Parent Site">
                                    <option disabled selected value="">Parent Site Select...</option>
                                    <option value="0">Is Parent Site</option>
                                    <option v-for="(parent_site,index) in parent_sites" v-bind:key="index" v-bind:value="parent_site.id">{{ parent_site.description }}</option>
                                </select>
                                <span class="help-block"><strong class="text-danger">{{ errors.parent_site == undefined ? '' : errors.parent_site[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button class="btn btn-primary btn-block btn-flat"><i class="fa fa-save"></i> {{ edit == false ? 'Save' : 'Update' }} {{ general.title }}</button>
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
                                    <input type="text" name="search" id="search" class="form-control form-control-sm" v-bind:placeholder="'Search ' + general.title_plural" v-model="keyword" v-on:keyup="getInfo()">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-condensed">
                            <thead class="thead-dark">
                                <tr role="row">
                                    <th width="10%">#</th>
                                    <th width="75%">Site</th>
                                    <th width="15%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(site,index) in sites" v-bind:key="index">
                                    <td>{{ pagination.first_rec + index }}</td>
                                    <td>{{ (site.parent_site ? site.parent_site + " : " : "") + site.description }}</td>
                                    <td class="text-center">
                                        <button @click="editRecord(site)" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button>
                                        <button @click="deleteRecord(site.id)" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
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
    </div>
</template>

<script>
import { constants } from 'crypto';
    export default {
        mounted() {
            
        },
        data() {
            return {
                general: {
                    title: 'Site',
                    title_plural: 'Sites'
                },
                parent_sites: [],
                sites: [],
                site: {
                    id: '',
                    description: '',
                    parent_id: '',
                    parent_site: ''
                },
                edit: false,
                site_id: '',
                pagination: {},
                errors: {},
                keyword: ''
            }
        },
        created() {
            this.getInfo();
            this.getParent();
        },
        methods: {
            getInfo(page_url) {
                page_url = page_url || '/api/setup/sites/' + this.keyword
                
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        let vm = this;
                        this.sites = res.data;
                        vm.makePagination(res.next_page_url, res.prev_page_url, res.current_page, res.last_page, res.from, res.to, res.total);
                    });
            },
            getParent() {
                fetch('/api/list/sites/parent')
                    .then(res => res.json())
                    .then(res => {
                        let vm = this;
                        this.parent_sites = res.data;
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

                fetch('/api/setup/sites', {
                    method: mtd,
                    body: JSON.stringify(this.site),
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
                            this.getParent();
                            $('input[name="description"]').focus();
                        }
                    })
                    .catch(err => console.log(err));
            },
            editRecord(site) {
                this.edit = true;
                this.site.id = site.id;
                this.site_id = site.id;
                this.site.description = site.description;
                this.site.parent_id = site.parent_id;
                this.site.parent_site = site.parent_site;
                $('input[name="description"]').focus();
            },
            deleteRecord(id) {
                if (confirm('Are You Sure?')) {
                    fetch(`/api/setup/sites/${id}`, {
                    method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.getInfo();
                        this.getParent();
                    })
                    .catch(err => console.log(err));
                }
            },
            clearForm() {
                this.edit = false;
                this.errors = {};
                this.site.id = null;
                this.site_id = null;
                this.site.description = '';
                this.site.short_name = '';
                this.site.parent_id = '';
                this.site.parent_site = '';
                $('input[name="description"]').focus();
            }
        }
    }
</script>