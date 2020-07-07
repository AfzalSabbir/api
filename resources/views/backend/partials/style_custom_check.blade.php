<style type="text/css">
  /* INPUT */
  input[type=checkbox] {
    -webkit-appearance: none;
       -moz-appearance: none;
            appearance: none;
    width: 40px;
    height: 16px;
    border: 1px solid #aaa;
    border-radius: 2px;
    background: #ebebeb;
    position: relative;
    display: inline-block;
    overflow: hidden;
    vertical-align: middle;
    transition: background 0.3s;
    box-sizing: border-box;
  }

  input[type=checkbox]:after {
    content: "";
    position: absolute;
    top: 0;
    left: -1px;
    width: 14px;
    height: 14px;
    background: white;
    border: 1px solid #aaa;
    border-radius: 2px;
    transition: left 0.1s cubic-bezier(0.785, 0.135, 0.15, 0.86);
  }

  input[type=checkbox]:checked {
    /* background:#5cb85c;
    border-color:#8daee5 ;*/
    /* background: #28a745;
    border-color: #07871f; */
    
    background: var(--nav-primary) !important;
    border-color: var(--nav-dark) !important;
  }

  input[type=checkbox]:checked:after {
    left: 23px;
    border-color: #8daee5;
  }

  input[type=checkbox]:hover:not(:checked):not(:disabled):after,
  input[type=checkbox]:focus:not(:checked):not(:disabled):after {
    left: 0px;
  }

  input[type=checkbox]:hover:checked:not(:disabled):after,
  input[type=checkbox]:focus:checked:not(:disabled):after {
    left: 22px;
  }

  input[type=checkbox]:disabled {
    opacity: 0.5;
  }
</style>