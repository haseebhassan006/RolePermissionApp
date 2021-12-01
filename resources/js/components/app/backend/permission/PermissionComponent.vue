<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">Permissions</h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <PrimaryButton  label="Add Permission"  v-on:activemodal="openModal($event)"></PrimaryButton>
                <div class="dropdown ml-auto sm:ml-0">
                    <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                        <span class="w-5 h-5 flex items-center justify-center"><i class="w-4 h-4" data-feather="plus"></i></span>
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
        <PermissionTable></PermissionTable>
             <vs-dialog v-model="active_modal">
        <template #header>
          <h4 class="not-margin">
            Create <b>Permission</b>
          </h4>
        </template>
        <div class="con-form">
          <vs-input  placeholder="Email">
            <template #icon>
              @
            </template>
          </vs-input>
          <vs-input type="password"  placeholder="Password">
            <template #icon>
              <i class='bx bxs-lock'></i>
            </template>
          </vs-input>
          <div class="flex">
            <vs-checkbox>Remember me</vs-checkbox>
            <a href="#">Forgot Password?</a>
          </div>
        </div>

        <template #footer>
          <div class="footer-dialog">
            <vs-button block>
              Sign In
            </vs-button>

            <div class="new">
              New Here? <a href="#">Create New Account</a>
            </div>
          </div>
        </template>
      </vs-dialog>

    </div>
</template>
<script>
import PermissionTable from './PermissionTable.vue'
import PrimaryButton from '../components/PrimaryButton.vue'
  export default{
        components:{
          PermissionTable,
          PrimaryButton
        },
        data(){
            return {
            active_modal:false,
            loading:false,
            edit_mode:false,
            }
        },
        methods:{
        openModal(val){
            return this.active_modal=val;
        },
        getPermissions(){
            return this.loading = true;
        }
    },
    mounted(){
        this.getPermissions()
    }
  }
</script>
<style scopped>

.vs-dialog{

    min-width: 602px;
    height: 359px;

}
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

</style>
