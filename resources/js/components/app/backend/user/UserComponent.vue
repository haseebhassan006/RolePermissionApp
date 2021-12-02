<template>
<div>
     <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Users
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <!-- <button class="btn btn-primary shadow-md mr-2">Add New Product</button> -->
                        <PrimaryButton  label="Add User"  v-on:activemodal="openModal($event)"></PrimaryButton>
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                            </button>
                            <div class="dropdown-menu w-40">
                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New Category </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> New Group </a>
                                </div>
                            </div>
                        </div>
                    </div>
         </div>

         <UserTable></UserTable>
  <content-placeholders v-if="loading">
            <content-placeholders-heading :img="true" />
            <content-placeholders-text :lines="1" />
            <content-placeholders-heading :img="true" />
            <content-placeholders-text :lines="1" />
            <content-placeholders-heading :img="true" />
            <content-placeholders-text :lines="1" />
            <content-placeholders-heading :img="true" />
            <content-placeholders-text :lines="1" />
          </content-placeholders>
      <vs-dialog overflow-hidden full-screen v-model="active_modal">
        <template #header>
          <h4 class="not-margin">
             Create <b>User</b>
          </h4>
        </template>


        <div class="con-form">
            <div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
        <p class="mt-1 text-sm text-gray-600">
          Use a permanent address where you can receive mail.
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="#" method="POST">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">

                <vs-input primary  placeholder="First Name" />
              </div>

              <div class="col-span-6 sm:col-span-3">

               <vs-input primary  placeholder="Last Name" />
              </div>

              <div class="col-span-6 sm:col-span-3">

               <vs-input primary  placeholder="Email address" />
              </div>

              <div class="col-span-6 sm:col-span-3">
                <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="city" id="city" autocomplete="address-level2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                <input type="text" name="region" id="region" autocomplete="address-level1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <vs-button block>
              Sign In
            </vs-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

        </div>

        <template #footer>
          <div class="footer-dialog">


            <div class="new">
              New Here? <a href="#">Create New Account</a>
            </div>
          </div>
        </template>
      </vs-dialog>
</div>

</template>
<script>
import UserTable from './UserTable.vue'
import UserForm from './UserForm.vue'
import PrimaryButton from '../components/PrimaryButton.vue'
export default{
    components:{
        UserTable,
        UserForm,
        PrimaryButton
    },
    data(){
        return {
            active_modal:false,
            loading:false,
            edit_mode:false,
            loading:false,
            value: [
        { name: 'Javascript', code: 'js' }
      ],
         options: [
        { name: 'Vue.js', code: 'vu' },
        { name: 'Javascript', code: 'js' },
        { name: 'Open Source', code: 'os' }
      ]

        }
    },


    methods:{
          openModal(val){
            return this.active_modal=val;
        },


        async getUsers(page=1){
             this.loading=true;
            //  this.page_num=page;
            //  const url="/management/role?page=" + page + "&query=" + this.query;
            //    await axios.get(url).then((res)=>{
            //        this.roles = res.data.roles;
            //        this.users=res.data.users
            //        console.log(res.data)
            //        this.loading=false;

            //    }).catch((err)=>{
            //          this.$root.alertErrorMessage(err.response.status,err.response.data);
            //    });
            },

    },
    mounted(){
        this.getUsers();

    }


}
</script>
<style scopped>
.vs-checkbox-label{
       font-size: .8rem

}
.vs-input-content{
      margin: 10px 0px;
      width :calc(100%);

}
.vs-input{
     width: 100%

}
.multiselect__option--highlight {
    background: #163287;

}
.multiselect__tag {
     background: #163287;

}

</style>
