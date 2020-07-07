<template>
    <div>
      
    </div>
</template>

<script>
    export default {
        props: ['auth_id', 'auth_mobile', 'domain', 'locale', 'file_default', 'file_form_field', 'file_table'],
        mounted() {
            // console.log('app started!');
            // these are for access necessary data from anywhere of the application

            this.$store.commit('setAuth', this.auth_id); // for access admin id 

            this.$store.commit('setAuthMobile', this.auth_mobile); // for access admin mobile

            // for access domain
            this.$store.commit('setUrl', {
                our_domain: this.domain
            });

            // for get locale
            this.$store.commit('setLocale', {
                locale: this.locale
            });

            // for language default file
            this.$store.commit('setDefault', {
              file_default: this.file_default 
            });

            // for language form field file
            this.$store.commit('setFormField', {
              file_form_field: this.file_form_field 
            });

            // for language table file
            this.$store.commit('setTableFile', {
              file_table: this.file_table 
            });
        },
    };
</script>
