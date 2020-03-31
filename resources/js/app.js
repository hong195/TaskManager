/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/ru';

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const compareDate = new Date();

console.log(compareDate)

const app = new Vue({
    components: { DatePicker },
    data:{
        startDate: null,
        endDate: null,
        lang: {
            formatLocale: {
                firstDayOfWeek: 1,
            },
            monthBeforeYear: false,
        },
        compareDate: null
    },
    methods: {
        formatDate(date) {
            if (!date) {
                return ''
            }
            let d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        },
        disableDate(date) {
            let compareDate
            if (this.compareDate) {
                compareDate = new Date(this.compareDate)
            }else {
                compareDate = new Date()
            }
            return date > compareDate
        }
    },
}).$mount('#app');

$(document).ready(function(){
    $('.staticList').not('.system').click(function(event) {
        event.preventDefault();
        $('.staticList').removeClass('active')
        $(this).addClass('active');
    });
    $('.departments .staticList').click(function() {
        const department_id = $(this).data('id');
        $('.blocks').addClass('d-none').removeClass('d-flex');
        $('.blocks[data-id="' + department_id + '"]').removeClass('d-none').addClass('d-flex')
    })

    $('.step').click(function(event) {
        event.preventDefault()

        const id =  $(this).data('id'),
              parent = $('.single-cell[data-id='+ id +']'),
              stepName = parent.data('name'),
              status = parent.data('status'),
              deadline = parent.data('deadline'),
              person = parent.data('person'),
              start = parent.data('start'),
              modalWrap = $('#step__info');

        modalWrap.find('.name').text(stepName)
        modalWrap.find('.status').text(status)
        modalWrap.find('.deadline').text(deadline)
        modalWrap.find('.person').text(person)
        modalWrap.find('.start').text(start)

        modalWrap.modal()
    })

    $('#exampleModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget)
        const cell_id = button.data('cell-id')

        const modal = $(this)
        const id =  $(this).data('id'),
            parent = $('.blocks[data-id='+ cell_id +']'),
            cellDeadline = parent.data('cell-deadline')

        console.log(cellDeadline)
        app.startDate = ''
        app.endDate = ''
        app.compareDate = cellDeadline
        modal.find('#cell_id').val(cell_id)
    })

    $('.step__delete').click(function(event){
        event.preventDefault()
    })
    $('#destroyStep').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget)
        const url = button.attr('href')
        const modal = $(this)
        modal.find('form').attr('action', url)
    })

    $('#stepEdit').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget),
             url = button.attr('href'),
             cell_id = button.data('cell-id')
        const step_id = button.data('id'),
            parent = $('.single-cell[data-id='+ step_id +']')
        const modalForm = $(this).find('form')

        modalForm.attr('action', url)
        modalForm.find('.cell_id').val(cell_id)
        modalForm.find('.name').val(parent.data('name'))
        modalForm.find('.name').val(parent.data('name'))
        modalForm.find('.status').val(parent.data('status'))
        modalForm.find('.person').val(parent.data('person'))

        app.endDate = new Date(parent.data('deadline'))
        app.startDate = new Date(parent.data('start'))

    })

    $('#cellEdit').on('show.bs.modal', function (event) {
        const dataSet = event.relatedTarget.dataset,
              modal = $(this)

        modal.find('.name').val(dataSet.cellName)
        modal.find('#status').val(dataSet.status)
        modal.find('form').attr('action', dataSet.action)
        app.endDate = new Date(dataSet.deadline)

    })

    $('#cellInfo').on('show.bs.modal', function (event) {
        const dataSet = event.relatedTarget.dataset,
            modal = $(this)

        modal.find('.name').text(dataSet.cellName)
        modal.find('#status, .status').text(dataSet.status)
        modal.find('.deadline').text(dataSet.deadline)


    })
})
