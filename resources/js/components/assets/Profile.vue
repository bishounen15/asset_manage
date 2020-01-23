<template>
    <div>
        <section class="content">
            <div class="row">
                <div class="col-sm-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/storage/default.png" alt="User profile picture">

                        <h3 class="profile-username text-center">{{asset_info.record.serial}}</h3>

                        <p class="text-muted text-center">{{asset_info.record.type}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                            <b>Brand</b> <a class="pull-right">{{asset_info.record.brand}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Model</b> <a class="pull-right">{{asset_info.record.model}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Status</b> <a class="pull-right">{{asset_info.record.status}}</a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
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
                        <li class=""><a href="#disks" data-toggle="tab" aria-expanded="false">Disks</a></li>
                        <li class=""><a href="#apps" data-toggle="tab" aria-expanded="false">Applications</a></li>
                        </ul>
                        <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Host Name</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.host_name" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Site</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.site" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Device Status</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.device_status" readonly>
                                    </div>
                                </div>                                
                            </form>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="specs">
                            
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">OS</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.os" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Processor</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.proc" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">RAM</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.ram" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">HDD</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.hdd" readonly>
                                    </div>
                                </div>                                

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Graphics Card</label>

                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" v-bind:value="asset_info.record.gfx_card" readonly>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="network">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ asset_info.network.from }} to {{ asset_info.network.to }} of {{ asset_info.network.total }} entries</div>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(network,index) in asset_info.network.data" v-bind:key="index">
                                        <td>{{ asset_info.network.from + index }}</td>
                                        <td>{{ network.ip }}</td>
                                        <td>{{ network.mac }}</td>
                                        <td>{{ network.name }}</td>
                                        <td>{{ network.descr }}</td>
                                        <td>{{ network.interface }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="dataTables_paginate paging_simple_numbers pull-right">
                                        <ul class="pagination">
                                            <li v-bind:class="[{ disabled: !pagination.prev_page }]" class="paginate_button previous"><a href="#" @click="!!pagination.prev_page && getInfo(pagination.prev_page)">Previous</a></li>
                                            <li class="paginate_button disabled" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Page {{ asset_info.network.current_page }} of {{ asset_info.network.last_page }}</a></li>
                                            <li v-bind:class="[{ disabled: !pagination.next_page }]" class="paginate_button next"><a href="#" @click="!!pagination.next_page && getInfo(pagination.next_page)">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="disks">
                            disks
                        </div>

                        <div class="tab-pane" id="apps">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ asset_info.application.from }} to {{ asset_info.application.to }} of {{ asset_info.application.total }} entries</div>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(app,index) in asset_info.application.data" v-bind:key="index">
                                        <td>{{ asset_info.application.from + index }}</td>
                                        <td>{{ app.install_date }}</td>
                                        <td>{{ app.app_name }}</td>
                                        <td>{{ app.version }}</td>
                                        <td>{{ app.install_type }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="dataTables_paginate paging_simple_numbers pull-right">
                                        <ul class="pagination">
                                            <li v-bind:class="[{ disabled: !asset_info.application.prev_page_url }]" class="paginate_button previous"><a href="#" @click="!!asset_info.application.prev_page_url && getApps(asset_info.application.prev_page_url)">Previous</a></li>
                                            <li class="paginate_button disabled" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Page {{ asset_info.application.current_page }} of {{ asset_info.application.last_page }}</a></li>
                                            <li v-bind:class="[{ disabled: !asset_info.application.next_page_url }]" class="paginate_button next"><a href="#" @click="!!asset_info.application.next_page_url && getApps(asset_info.application.next_page_url)">Next</a></li>
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
        this.getInfo();
    },
    data() {
        return {
            asset_info: {
                record: {},
                network: {},
                disk: {},
                application: {},
            },
            pagination: {}
        }
    },
    created() {
        
    },
    props: {
        asset_id: Number
    },
    methods: {
        getInfo() {
            let page_url = '/api/asset/profile/' + this.asset_id;
                
            fetch(page_url, {
                method: 'post',
                })
                .then(res => res.json())
                .then(res => {
                    let vm = this;
                    vm.asset_info.record = res.record;
                    vm.getNetwork();
                })
                .catch(err => console.log(err));
        },
        getNetwork(page_url) {
            page_url = page_url || '/api/asset/network/' + this.asset_id;
                
            fetch(page_url, {
                method: 'post',
                })
                .then(res => res.json())
                .then(res => {
                    let vm = this;
                    vm.asset_info.network = res;
                    vm.getApps();
                })
                .catch(err => console.log(err));
        },
        getApps(page_url) {
            page_url = page_url || '/api/asset/apps/' + this.asset_id;
                
            fetch(page_url, {
                method: 'post',
                })
                .then(res => res.json())
                .then(res => {
                    let vm = this;
                    this.asset_info.application = res;
                })
                .catch(err => console.log(err));
        }
    }
}
</script>