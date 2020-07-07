<template>
    <nav aria-label="...">
        <ul class="pagination pagination-sm justify-content-center">
            <li class="page-item cursor-pointer" :class="{ disabled: pagination.current_page <= 1 }">
                <a class="page-link" @click.prevent="changePage(pagination.current_page - 1)">Previous</a>
            </li>
            <li class="page-item cursor-pointer" :class="isCurrentPage(1) ? 'active' : ''">
                <a class="page-link" @click.prevent="changePage(1)"  >1
                    <span v-if="isCurrentPage(1)" class="sr-only">(current)</span>
                </a>
            </li>


            <li v-if="leftDots_" class="page-item cursor-default disabled">
                <a class="page-link" @click.prevent="">...</a>
            </li>
            <li class="page-item cursor-pointer" v-for="page in pages" :key="page" :class="isCurrentPage(page) ? 'active' : ''">
                <a class="page-link" @click.prevent="changePage(page)">{{ page }}
                    <span v-if="isCurrentPage(page)" class="sr-only">(current)</span>
                </a>
            </li>
            <li v-if="rightDots_" class="page-item cursor-default disabled">
                <a class="page-link" @click.prevent="">...</a>
            </li>


            <li class="page-item cursor-pointer" :class="isCurrentPage(pagination.last_page) ? 'active' : ''">
                <a class="page-link" @click.prevent="changePage(pagination.last_page)">{{ pagination.last_page }}
                    <span v-if="isCurrentPage(pagination.last_page)" class="sr-only">(current)</span>
                </a>
            </li>
            <li class="page-item cursor-pointer" :class="{ disabled: pagination.current_page >= pagination.last_page }">
                <a class="page-link" @click.prevent="changePage(pagination.current_page + 1)">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'Pagination',
        props:['pagination', 'offset'],
        data() {
            return {
                leftDots_: false,
                rightDots_: true
            }
        },
        mounted() {
        },
        methods: {
            isCurrentPage(page){
                return this.pagination.current_page === page
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;

                
                if (this.offset >= page) this.leftDots_ = false;
                else this.leftDots_ = true;


                if (this.pagination.last_page - this.offset + 1 <= page) this.rightDots_ = false;
                else this.rightDots_ = true;

                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = []
                let from = this.pagination.current_page - Math.floor(this.offset / 2)
                if (from < 1) {
                    from = 1
                }
                let to = from + this.offset - 1

                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page
                }
                while (from <= to) {
                    if (from > 1 && from < this.pagination.last_page) {
                        pages.push(from)
                    }
                    from++
                }

                return pages
            }
        }
    };
</script>