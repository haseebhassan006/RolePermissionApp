<template>
   <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Role
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <PrimaryButton  label="Add Role"  v-on:activemodal="openModal($event)"></PrimaryButton>
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
        <RoleTable :getRoles="getRoles" :roles="roles" v-on:editItem="editItem($event)" v-on:deleteItem="deleteItem($event)" v-else></RoleTable>
        <vs-dialog v-model="active_modal">
        <template #header>
          <h4 class="not-margin">
            Create <b>Role</b>
          </h4>
        </template>
        <div class="con-form">
          <vs-input  placeholder="Role" v-model="role.name"></vs-input>
          <vs-select  

        filter
        multiple
        collapse-chips
        placeholder="Select Users"
        v-model="selected_users"
       
      >
        <vs-option  v-for="item in users" label="Vuesax"  :key="item.id" :label="item.name" :value="item.id">
           {{ item.name }}
        </vs-option>
      </vs-select>
          <div class="flex">
          </div>
        </div>

        <template #footer>
          <div class="footer-dialog">
            <vs-button  gradient  type="submit" @click="onSubmit">
              Add Role
            </vs-button>

        
          </div>
        </template>
      </vs-dialog>
   </div>

</template>
<script>
import RoleTable from './RoleTable.vue'
import PrimaryButton from '../components/PrimaryButton.vue'
export default{
    components:{
        RoleTable,
        PrimaryButton
    },
    data(){
        return {
            active_modal:false,
            loading:false,
            edit_mode:false,
            value3:[1,2,4,2,5],
            selected_users:[],
            users:{},
            errors:[],
            page_num:1,
            query:"",
            roles:{},
            role:{},
        }
    },
    methods:{
        openModal(val){
            this.resetForm();
            return this.active_modal=val;
        },   
        resetForm(){
            this.edit_mode=false;
            this.active_modal=false;
            this.role={};
            this.selected_users=[];
        },
        async getRoles(page=1){
             this.loading=true;
             this.page_num=page;
             const url="/api/management/role?page=" + page + "&query=" + this.query;
               await axios.get(url).then((res)=>{
                   this.roles = res.data.roles;
                   this.users=res.data.users
                   console.log(res.data)
                   this.loading=false;

               }).catch((err)=>{
                     this.$root.alertErrorMessage(err.response.status,err.response.data);
               });
        },
        deleteItem(item){
            const url=`/api/management/role/${item.id}`;
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
                        this.getRoles();

                  }).catch((err)=>{
                        this.$root.alertNotificationMessage(err.response.status,err.response.data);
                   //    console.log("erro",err.response.data.message);

                  });
              }
            });
          },
        isquery(query) {
            return (this.query = query);
        },
        filterdata(data){
            this.roles=data.roles;
          },
        loadingStart(value) {

            this.loading = value;
        },
        editItem(item) {
            this.resetForm();
            this.edit_mode=true;
            this.active_modal=true;
            this.role=item;
            this.selected_users=item.users.map(x=> x.id)
            },
        onSubmit(){
            let formData = new FormData();
                formData=Object.assign(this.role,formData);
                formData=Object.assign({users:this.selected_users},formData)
                const url="/api/management/role";
                if(!this.edit_mode){
                    axios.post(url,formData).then((res)=>{
                    this.$root.alertNotificationMessage(res.status,"New role has been created successfully")
                    this.resetForm();
                    this.getRoles();

                }).catch((err)=>{
                     if(err.response.status==422){
                        this.errors=err.response.data.errors;
                        return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                    }
                    this.$root.alertNotificationMessage(err.response.status,err.response.data);
                });
                }
                else {
                    let data={id:this.role.id,name:this.role.name,users:this.selected_users};
                    axios.put(url+"/"+this.role.id,data).then((res)=>{

                     this.getRoles();
                     this.resetForm();
                    this.$root.alertNotificationMessage(res.status,"Role has been updated successfully");

                }).catch((err)=>{
                     if(err.response.status==422){
                        this.errors=err.response.data.errors;
                        return this.$root.alertNotificationMessage(err.response.status,err.response.data.errors);
                    }
                    this.$root.alertNotificationMessage(err.response.status,err.response.data);
                });
                }

        },

    },
    mounted(){
        this.getRoles()
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
