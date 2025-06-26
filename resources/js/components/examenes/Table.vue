<template>
<div>
    <filter-bar></filter-bar>
    <div class="table-responsive">
        <vuetable ref="vuetable" api-url="/examenes" :fields="fields" :sort-order="sortOrder" :css="css.table" pagination-path="" :per-page="per_page" :append-params="moreParams" @vuetable:pagination-data="onPaginationData" @vuetable:loading="onLoading" @vuetable:loaded="onLoaded" no-data-template="Sin resultados">
            <template slot="roles" slot-scope="props">
                <div class="text-center align-middle" v-if="props.rowData.roles.length > 0">
                    <span class="badge badge-primary mr-1"
                        v-for="role in props.rowData.roles" :key="role.id">
                        <span v-if="showRole(role)">{{ role.description }}</span>
                    </span>
                </div>
                 <div class="text-center align-middle" v-else>
                     <span class="badge badge-secondary mr-1">
                        <span>Registro</span>
                     </span>
                 </div>
            </template>
            <template slot="actions" slot-scope="props">
                <div class="text-center align-middle actions mx-auto" style="width:110px;">
                    <button class="btn btn-warning btn-sm"
                        v-can="'appointments.update'"
                        v-if="!props.rowData.meet_sent_at"
                        @click.prevent="$emit('update-item',props.rowData)" data-toggle="tooltip" title="Editar Registro">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </template>
      </vuetable>
    </div>
    <div class="row paginate">
        <div class="col-md-6">
            <vuetable-pagination-info ref="paginationInfo" info-template="Mostrando del {from} al {to} de un total de {total} registros" no-data-template="Sin resultados">
            </vuetable-pagination-info>
        </div>
        <div class="col-md-6 text-right">
            <vuetable-pagination ref="pagination" :css="css.pagination" @vuetable-pagination:change-page="onChangePage">
            </vuetable-pagination>
        </div>
    </div>
</div>
</template>

<script>
import {Vuetable, VuetablePagination, VuetablePaginationInfo} from "vuetable-2";
import TableCssConfig from "../../../configs/VueTable2Bs4";
import moment from 'moment';
export default {
    components: {
        Vuetable,
        VuetablePagination,
        VuetablePaginationInfo,
        FilterBar
    },
    data() {
        return {
            fields: [
                {
                    name: 'offer.id',
                    title: 'Folio',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                },
                {
                    name: 'store.name',
                    title: 'Cadena',
                    titleClass: 'text-center',
                    sortField: 'store_id',
                    dataClass: 'text-center align-middle',
                },
                {
                    name: 'offer.buyer.full_name',
                    title: 'Comprador',
                    titleClass: 'text-left',
                    dataClass: 'text-left align-middle',
                },
                {
                    name: 'offer.manufacturer.company.name',
                    title: 'Fabricante',
                    titleClass: 'text-left',
                    dataClass: 'align-middle',
                },
                {
                    name: 'offer.product.barcode',
                    title: 'GTIN',
                    titleClass: 'text-left',
                    dataClass: 'align-middle',
                },
                {
                    name: 'offer.product.name',
                    title: 'Producto',
                    titleClass: 'text-left',
                    dataClass: 'align-middle',
                },
                {
                    name: 'start_at',
                    title: 'Inicia',
                    sortField: 'start_at',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                    callback: 'formatDateTime',
                },
                {
                    name: 'meet_url',
                    title: 'Meet Url',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                },
                {
                    name: 'meet_sent_at',
                    title: 'Fecha de Envio',
                    sortField: 'meet_sent_at',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                    callback: 'formatDate',
                },
                {
                    name: '__slot:actions',
                    title: 'Acciones',
                    titleClass: 'text-center',
                    dataClass: 'text-center align-middle',
                }
            ],
            sortOrder: [{
                field: 'start_at,store_id',
                direction: 'asc,asc'
            }],
            moreParams: {
                'query': ''
            },
            per_page: 10,
            css: TableCssConfig,
        }
    },
    mounted() {
        this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
        this.$events.$on('filter-reset', e => this.onFilterReset())
        this.$events.$on('per-page-set', eventData => this.onPerPageChange(eventData))
        this.is_super_user = this.authSuperUser();
    },
    methods: {
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
            this.$refs.paginationInfo.setPaginationData(paginationData)
        },
        onChangePage(page) {
            this.$refs.vuetable.changePage(page)
        },
        editRow(rowData) {
            alert("You clicked edit on" + JSON.stringify(rowData))
        },
        deleteRow(rowData) {
            alert("You clicked delete on" + JSON.stringify(rowData))
        },
        onLoading() {
            //console.log('loading... show your spinner here')
            this.$events.fire('set-loading', true);
        },
        onLoaded() {
            //console.log('loaded! .. hide your spinner here')
            this.$events.fire('set-loading', false);
        },
        formatDate(value) {
            if (value != null)
                return moment(value).format('DD/MM/YYYY');
            return ''
        },
        formatDateTime(value) {
            if (value != null)
                return moment(value).format('DD/MM/YYYY HH:mm');
            return ''
        },
        formatType(value) {
            if(value == 1){
                return 'Cadena Comercial'
            }else if(value == 2){
                return 'Proveedor de Tecnología'
            }else{
                return 'Actor Clave'
            }
        },
        formatImage(value) {
            return value == null ? '' :
                '<img class="img-fluid" style="max-height:32px;" src="'+ value +'">'
        },
        formatVideo(value) {
            return value == null ? '' :
                '<a target="_blank" href="'+ value +'"><i class="fas fa-video"></i></a>'
        },
        formatStatus(value) {
            return value ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
        },
        onFilterSet({query}) {
            this.moreParams = {
                'query': query
            }
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onFilterReset() {
            this.moreParams = {
                'query': ''
            }
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        onPerPageChange(perPage) {
            this.per_page = perPage;
            Vue.nextTick(() => this.$refs.vuetable.refresh())
        },
        authSuperUser(){
            let found = Laravel.user.roles.find(element => element.name == 'root');
            if (found !== undefined)
                return true;
            return false;
        },
        showRole(role){
            if (this.is_super_user)
                return true;
            if(role.name === 'root')
                return false;
            return true;
        }
    }
};
</script>
