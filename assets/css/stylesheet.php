<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
  body{
    background: #f2f2f2;
  }
    .xero_settings_title{
      font-size:1.75rem;
      color: #171D4B;
      font-weight: 700;
    }
      .heading{
      position: relative;
      padding-left: 2rem;
      width: 100%;
      height: 4rem;
    }
    .heading > span{
      display: flex;
      align-items: center;
    }
      #wrappers{
        padding:0;
        height:100vh;
      }
.modal {
  display: none; 
  position: fixed;
    padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}
input[type="text"],input[type=time],select,#casualEmp_date{
  background: #ebebeb;
  border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
}
/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.ent-btn{
    background: #ebebeb;
    border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
    text-align: center;
}    }
    #wrappers{
      height:100vh;
      overflow-y: hidden;
    }
#content-wrappers{
    padding: 0  2rem 2rem 3rem;
    height:calc(100vh - 4rem);
}
.content-wrappers-child{
    background: white;
    height: 100%;
    overflow-y: auto;
}
.row{
  display: block !important;
}

.table td, .table th {
    padding: 1rem !important;
    vertical-align: top;
     border-top: 0px !important; 
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 0 !important;
}
.submit-edit,.cancel-edit{

}
  .submit-edit,
  .cancel-edit,
  .button,
  #create_new_entitlements,
  #cancel_new_entitlements{
    border: none;
    color: rgb(23, 29, 75);
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-weight: 700;
    margin: 2px;
    width:auto;
      border-radius: 20px;
      padding: 8px;
      background: rgb(164, 217, 214);
}
    .fa-pencil-alt,.fa-trash-alt{
      color: #171D4B !important;
      font-weight: 700;
      font-style: normal;
    }
  .create-ent{
    display: flex;
    margin-right:2rem;
    justify-content: center;
    align-items: center;
  }
  .row{
    margin: 0 !important;
  }
  .table{
    font-size: 1rem;
    background-color: white;
    width: 100%;
    margin: auto;
    text-align: center;
   }
    thead tr{
      background-color: #8D91AA;
      color: #F3F4F7;
    }
    tr{
      border-top:  1px solid #d2d0d0;
      border-bottom: 1px solid #d2d0d0;
    }
    tbody tr{
      background: white !important;
    }
.button{
  /*position: absolute;*/
/*  right: 0;*/
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
      display: flex;
      align-items: center;
}
    .button a{
      font-size: 1rem;
      color: #171d4b;
    }
    .xero_button{
      display: flex;
      justify-content: center;
    }
    </style>

    <?php } ?>