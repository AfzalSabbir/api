<template>
  <div class="overflow-auto">
    <div class="mt-3">
      <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        first-number
        last-number
      ></b-pagination>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'SearchPagination',
    props: ['filter', 'type', 'query', 'action', 'result'],
    data() {
      return {
        page_items: JSON.parse(this.result),
        rows: 0,
        perPage: 1,
        currentPage: 1,
        items: []
      }
    },
    mounted() {
      this.rows = this.page_items.total;
      this.items = this.page_items.data;
      console.log(this.items);
    }
  };
</script>