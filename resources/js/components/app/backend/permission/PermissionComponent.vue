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
        <PermissionTable :getpermissions="getpermissions" :permissions="permissions" v-on:editItem="editItem($event)" v-on:deleteItem="deleteItem($event)" v-else></PermissionTable>
             <vs-dialog v-model="active_modal">
        <template #header>
             <h4 class="not-margin" v-if="!edit_mode">
               Create New <b>Permission</b>
            </h4>
            <h4 class="not-margin" v-else>
               Update <b>{{permission.name}}</b> Permission
            </h4>
        </template>
        <div class="con-form">
          <vs-input v-model="permission.name"  placeholder="Permission"> 
          </vs-input>
        <vs-select  filter placeholder="Select Roles"  :color="this.$root.primary_color" required   collapse-chips :multiple="true"  v-model="selected_roles" v-if="roles">
            <vs-option v-for="item in roles" :key="item.id"
                                :label="item.name" :value="item.id">
                                 {{ item.name }}
          </vs-option>
        </vs-select>
          <div class="mb-3">
                <label class="col-form-label" for="recipient-name">Users:</label>
                      <vs-select  filter placeholder="Select Users"  :color="this.$root.primary_color" required   collapse-chips :multiple="true"  v-model="selected_users" v-if="users">
                      <vs-option v-for="item in users" :key="item.id"
                                :label="item.name" :value="item.id">
                                 {{ item.name }}
                        </vs-option>
                     </vs-select>

          </div>
         
        </div>
        <template #footer>
          <div class="footer-dialog">
             <vs-button color="rgb(30, 32, 79)" gradient  type="submit" @click="onSubmit" >
                     Create Permission
                  </vs-button>
              
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
            permissions:{},
            permission:{},
            active_modal:false,
            edit_mode:false,
            selected_users:[],
            selected_roles:[],
            users:[],
            roles:[],
            errors:[],
            page_num:1,
            query:"",
            loading:false,
            
            }
        },
        methods:{
          onChange(event){
            console.log("log",event);
          },
          editItem(item) {
            this.resetForm();
             
            this.edit_mode=true;
            this.active_modal=true;
            this.permission=item;
            this.selected_users=item.users.map(x=> x.id);
            this.selected_roles=item.roles.map(x=> x.id);
            },
          deleteItem(item){
            const url=`/api/management/permission/${item.id}`;
            Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete(url).then((res) => {
                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        this.getpermissions();

                  }).catch((err)=>{
                        this.$root.alertNotificationMessage(err.response.status,err.response.data);
                   //    console.log("erro",err.response.data.message);

                  });
              }
            });
            },
          openModal(val){
             this.resetForm();
             return this.active_modal=val;
            },
          resetForm(){
            this.edit_mode=false;
            this.active_modal=false;
            this.permission={};
            this.selected_users=[];
            this.selected_roles=[];

            },
          isquery(query) {
            return (this.query = query);
          },
          filterdata(data){
            this.permissions=data.permissions;
          },
           loadingStart(value) {

            this.loading = value;
          },

        onSubmit(){
                let formData = new FormData();
                formData=Object.assign(this.permission,formData);
                formData=Object.assign({users:this.selected_users},formData)
                formData=Object.assign({roles:this.selected_users},formData)
                const url="/api/management/permission";
                if(!this.edit_mode){
                     axios.post(url,formData).then((res)=>{
                     this.$root.alertNotificationMessage(res.status,"New permission has been created successfully")
                     this.resetForm();
                     this.getpermissions();

                }).catch((err)=>{
                     if(err.response.status==422){
                        this.errors=err.response.data.errors;
                        return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                    }
                    this.$root.alertNotificationMessage(err.response.status,err.response.data);
                });
                }
                else {
                    let data={id:this.permission.id,name:this.permission.name,users:this.selected_users,roles:this.selected_roles};
                    axios.put(url+"/"+this.permission.id,data).then((res)=>{

                     this.getpermissions();
                     this.resetForm();
                    this.$root.alertNotificationMessage(res.status,"Permission has been updated successfully");

                }).catch((err)=>{
                     if(err.response.status==422){
                        this.errors=err.response.data.errors;
                        return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                    }
                    this.$root.alertNotificationMessage(err.response.status,err.response.data);
                });
                }

            },
          async getpermissions(page=1){
             this.loading=true;
             this.page_num=page;
             const url="/api/management/permission?page=" + page + "&query=" + this.query;
               await axios.get(url).then((res)=>{
                   this.permissions = res.data.permissions;
                   console.log(res.data.permission)
                   this.users=res.data.users;
                   this.roles=res.data.roles
                   this.loading=false;
               }).catch((err)=>{
                     this.$root.alertErrorMessage(err.response.status,err.response.data);
               });
            },

    },
    
    mounted(){
    this.getpermissions();
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
