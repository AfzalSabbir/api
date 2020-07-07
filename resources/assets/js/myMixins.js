export var myData = {
  data: {
    dat: "datae"
  }
};
export var isLoggedMixin = {
  methods: {
    checkIfLogged(url){
      var vm = this;
      return new Promise((resolve, reject) => {
        axios.get(url)
        .then(response => {
          this.isLoggedIn = response.data.admin ? true : false;
          if(!this.isLoggedIn) {
            window.location.href = this.base_url+'/admin/login';
          }
          console.log('isLoggedIn: '+this.isLoggedIn);
          // resolve(response.data);
        })
        .catch(error => {
          reject(error);
        });
      });
    }
  }
};


// export default isLoggedMixin;