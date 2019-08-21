<template>
    <div>
        <section class="content">
            <div class="row">
                <div class="col-sm-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/storage/default.png" alt="User profile picture">

                        <h3 class="profile-username text-center">{{asset_info.serial}}</h3>

                        <p class="text-muted text-center">{{asset_info.type}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                            <b>Followers</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                            <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                            <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab" aria-expanded="true">General Information</a></li>
                        <li class=""><a href="#specs" data-toggle="tab" aria-expanded="false">Specifications</a></li>
                        <li class=""><a href="#network" data-toggle="tab" aria-expanded="false">Network Details</a></li>
                        <li class=""><a href="#apps" data-toggle="tab" aria-expanded="false">Applications</a></li>
                        </ul>
                        <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            info
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="specs">
                            specs
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="network">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ pagination.first_rec }} to {{ pagination.last_rec }} of {{ pagination.total_rec }} entries</div>
                                </div>
                                <div class="col-xs-6">
                                    <!-- <button class="btn btn-md btn-info pull-right" data-toggle="modal" data-target="#input-form"><i class="fa fa-plus"></i> Add Asset</button> -->
                                </div>
                            </div>

                            <table class="table table-bordered table-condensed">
                                <thead class="thead-dark">
                                    <tr role="row">
                                        <th>#</th>
                                        <th>IP Address</th>
                                        <th>MAC Address</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Interface</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(network,index) in asset_info.networks" v-bind:key="index">
                                        <td>{{ pagination.first_rec + index }}</td>
                                        <td>{{ network.ip }}</td>
                                        <td>{{ network.mac }}</td>
                                        <td>{{ network.name }}</td>
                                        <td>{{ network.descr }}</td>
                                        <td>{{ network.interface }}</td>
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
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="apps">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ pagination.first_rec }} to {{ pagination.last_rec }} of {{ pagination.total_rec }} entries</div>
                                </div>
                                <div class="col-xs-6">
                                    <!-- <button class="btn btn-md btn-info pull-right" data-toggle="modal" data-target="#input-form"><i class="fa fa-plus"></i> Add Asset</button> -->
                                </div>
                            </div>

                            <table class="table table-bordered table-condensed">
                                <thead class="thead-dark">
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Install Date</th>
                                        <th>Application Name</th>
                                        <th>Version</th>
                                        <th>Install Type</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(app,index) in asset_info.apps" v-bind:key="index">
                                        <td>{{ pagination.first_rec + index }}</td>
                                        <td>{{ app.install_date }}</td>
                                        <td>{{ app.app_name }}</td>
                                        <td>{{ app.version }}</td>
                                        <td>{{ app.install_type }}</td>
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
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                    </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    mounted() {

    },
    data() {
        return {
            asset_info: {},
            pagination: {}
        }
    },
    created() {
        this.getInfo();
    },
    props: {
        asset_id: Number
    },
    methods: {
        getInfo() {
            this.asset_info.serial = 'TEST';
        }
    }
}
</script>