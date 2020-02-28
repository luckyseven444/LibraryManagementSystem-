<template>
<div>
    <input v-if="hit.val" type="text" value=author name="author" placeholder="Author?" v-model="searchquery" v-on:keyup="autoComplete" class="form-control">
    <input v-if="!hit.val" v-model="value" type="text" name="author1" placeholder="Author">
    <div v-if="hit.val" class="panel-footer">
        <ul class="list-group">
            <li class="list-group-item" v-for="result in data_results" @click="selectInput($event)">{{ result.first_name }} {{ result.last_name }}
            </li>
        </ul>
    </div>
</div>
</template>

<script>
    export default {
        props: ['author'],
        data: function () {
            return {
                hit: {val: true},
                searchquery: '',
                data_results: [],
                value: ''
            }
        },
        methods: {
            selectInput(event) {
                this.hit.val = !this.hit.val;
                this.value = event.target.parentElement.parentElement.parentElement.firstChild.nextElementSibling.firstChild.firstChild.innerHTML;
            },

            autoComplete() {
                this.data_results = [];
                if (this.searchquery.length > 2) {
                    axios.get('/vuejs/autocomplete/search', {params: {searchquery: this.searchquery}}).then(response => {
                        console.log(response);
                        this.data_results = response.data;
                    });
                }
            },

        }
    }
</script>

<style></style>