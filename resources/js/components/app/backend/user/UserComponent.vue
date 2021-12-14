<template>
<div>
  <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Users</h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
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
  <UserTable :getUsers="getUsers" :roles="roles" :users="users" v-on:deleteItem="deleteItem($event)" v-on:editItem="editItem($event)" v-else></UserTable>

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
              <h3 class="text-lg font-medium leading-6 text-gray-900">Create New User</h3>
            </div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-6">
                    <vs-input  v-model="user.name"   primary  placeholder="First Name" />
                  </div>
                  <div class="col-span-6 sm:col-span-6">
                    <vs-input  v-model="user.lname" primary  placeholder="Last Name" />
                  </div>
                  <div class="col-span-6 sm:col-span-3 ">
                    <vs-input primary v-model="user.email"  placeholder="Email address" />
                    
                  </div>
                  <div class="col-span-6 sm:col-span-3  lg:col-span-2">
                       <vs-select  filter multiple collapse-chips placeholder="Select Roles" v-model="user.roles">
                   <vs-option  v-for="item in roles"  :key="item.id" :label="item.name" :value="item.id">
                        {{ item.name }}
                      </vs-option>
                    </vs-select>
                     
                  </div>
                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                     <vs-input type="password" v-model="user.password" primary  placeholder="City" />
                  </div>
                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                     <vs-input type="password" v-model="user.password" primary  placeholder="City" />
                  </div>
            
                
                  <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                      <vs-input v-model="user.state" primary  placeholder="State" />
                  </div>
                  <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                     <vs-input v-model="user.zip" primary  placeholder="Zip Code" />
                  </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <vs-button color="rgb(30, 32, 79)" gradient  type="submit"  v-if="!edit_mode" @click="onSubmit">
                  Create User          
            </vs-button>
            <vs-button  color="rgb(59,222,200)" gradient  type="submit"  @click="onSubmit" v-if="this.edit_mode">
                     Update
            </vs-button>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
  <template #footer>
  <div class="footer-dialog">
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
            users:{},
        
            query:"",
            loading:false,
            total_users:0,
            active_modal:false,
            edit_mode:false,
            roles:{},
            user:{
            name:"",
            email:"",
            phone:"",
            last_name:"",
            password:"",
            address:"",
            zip:"",
            city:"",
            country:[],
            bio:"",
            roles:[],
        

        },
            page_num:1
      

        }
    },


    methods:{
          openModal(val){
            return this.active_modal=val;
        },
        async getRolesPerimissions(){
            await axios.get('/api/management/roles-perimissions').then((res)=>{
                 this.roles=res.data.roles;
             });
         },
           resetForm(){
            this.edit_mode=false;
            this.active_modal=false;
            this.role={};
            this.selected_users=[];
        },
            editItem(item) {
            this.resetForm();
            this.edit_mode=true;
            this.active_modal=true;
            this.role=item;
            this.selected_users=item.users.map(x=> x.id)
            },

        async getUsers(page=1){
                  this.loading =true;
                  this.page_num = page;
                 const url="/api/management/user?page=" + page + "&query=" + this.query;
               await axios.get(url).then((res)=>{
                   this.users = res.data.users;
                  
                   this.total_users=res.data.total_users;
                    this.roles=res.data.roles;
                   this.loading =false;
               }).catch((err)=>{
                        this.$root.alertNotificationMessage(err.response.status,err.response.data);

                  });
          },
           onSubmit(){
              let formData = new FormData();
                formData=Object.assign(this.user,formData);
                //  formData=Object.assign({selected_roles:this.selected_roles},formData)
                if(!this.edit_mode){
                    axios.post('/api/management/user',formData).then((res)=>{
                        this.$root.alertNotificationMessage(res.status,"New user has been created successfully");
                        setTimeout(() => {
                            this.$router.push({ name: 'users' })
                        }, 1000);
                    }).catch((err)=>{
                        if(err.response.status==422){
                            this.errors=err.response.data.errors;
                            return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                        }
                    this.$root.alertNotificationMessage(err.response.status,err.response.data);

                });
                }
                else {
                    axios.put('/api/management/user/'+this.user.id,formData).then((res)=>{
                        this.$root.alertNotificationMessage(res.status,"User has been updated successfully");
                        setTimeout(() => {
                            this.$router.push({ name: 'users' })
                        }, 1000);
                    }).catch((err)=>{
                        if(err.response.status==422){
                            this.errors=err.response.data.errors;
                            return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                        }
                    this.$root.alertNotificationMessage(err.response.status,err.response.data);
                });
                }
            }
    },
    mounted(){
       this.getRolesPerimissions();
       this.getUsers();
       if(this.$route.params.id){
            let url="/api/management/user/"+this.$route.params.id;
            axios.get(url).then((res)=>{
                this.user=res.data.user;

                this.edit_mode=true;
                let data=  {...res.data.user, ...res.data.user.user_info};
                this.user={...this.user,...data};

            }).catch((err)=>{
                     if(err.response.status==422){
                         this.errors=err.response.data.errors;
                        return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                    }
                  this.$root.alertNotificationMessage(err.response.status,err.response.data);

            });
        }
        else {
            this.edit_mode=false;
        }


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
.multiselect__option--selected{
    background: #163287;

}
.multiselect__option--highlight{
      background: #163287;
}
.multiselect__option .multiselect__option--highlight{
    background: #163287;

}

</style>
