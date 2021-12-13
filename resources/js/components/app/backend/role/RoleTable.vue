<template>
   <div class="intro-y box p-5 mt-5">
                    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                        <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                            <div class="sm:flex items-center sm:mr-4">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Field</label>
                                <select id="tabulator-html-filter-field" class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                                    <option value="name">Name</option>
                                    <option value="category">Category</option>
                                    <option value="remaining_stock">Remaining Stock</option>
                                </select>
                            </div>
                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Type</label>
                                <select id="tabulator-html-filter-type" class="form-select w-full mt-2 sm:mt-0 sm:w-auto" >
                                    <option value="like" selected>like</option>
                                    <option value="=">=</option>
                                    <option value="<">&lt;</option>
                                    <option value="<=">&lt;=</option>
                                    <option value=">">></option>
                                    <option value=">=">>=</option>
                                    <option value="!=">!=</option>
                                </select>
                            </div>
                            <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                                <input id="tabulator-html-filter-value" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                            </div>
                            <div class="mt-2 xl:mt-0">
                                <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Go</button>
                                <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reset</button>
                            </div>
                        </form>
                        <div class="flex mt-5 sm:mt-0">
                            <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </button>
                            <div class="dropdown w-1/2 sm:w-auto">
                                <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export <i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                        <a id="tabulator-export-csv" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export CSV </a>
                                        <a id="tabulator-export-json" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export JSON </a>
                                        <a id="tabulator-export-xlsx" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export XLSX </a>
                                        <a id="tabulator-export-html" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export HTML </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto scrollbar-hidden">
                        <div id="tabulator" class="mt-5 table-report table-report--tabulator"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordernone">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <vs-checkbox   @click="selectAllItems"></vs-checkbox>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Users</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                                     
                                <tr  v-for="role in roles.data" :key="role.id" >
                                    <td>
                                        <vs-checkbox >
                                        </vs-checkbox>
                                    </td>
                                     <td class="bd-t-none u-s-tb">
                                        <Avatar :name="role.name" :thumbnail="role.thumbnail"></Avatar>
                                        <a  role="button" @click="editItem(role)">
                                        <div class="align-middle image-sm-size">
                                            <div class="d-inline-block">
                                                <h6>{{role.name}} <span class="text-muted"></span></h6>
                                            </div>
                                        </div>
                                        </a>
                                    </td>
                                    <td>
                                    <vs-avatar :color="getColor()">
                                        <template #text>
                                            {{role.users.length}}
                                        </template>
                                    </vs-avatar>
                                    </td>
                                    <td>
                                      <vs-avatar :color="getColor()">
                                    <template #text>
                                     {{role.permissions.length}}
                                    </template>
                                </vs-avatar>
                                    </td>
                                    <td>{{role.created_at | timeformat}}</td>
                                    <td>
                                        <vs-button   role="button" @click="editItem(role)"> Edit</vs-button> 
                                        |<vs-button role="button"  @click="deleteItem(role)">Delete</vs-button></td>
                                   
                                </tr>

                            
                            </tbody>
                        </table>
                    </div>
                </div>
</template>
<script>
import Avatar from "../components/AvatarComponent.vue";
   export default{
        props:['roles','getRoles'],
          components: {
    Avatar
  },
        data(){ return{
        selected_items:[],
     }
    },
    methods:{
        getColor(){
            const val =Math.floor(Math.random() * 7);
      switch (val) {
          case 1:
              return "primary";
              break;
          case 2:
              return "dark";
              break;
          case 3:
              return "success";
              break;
          case 4:
              return "warn";
              break;
         case 5:
              return "#7d33ff";
              break;
          case 6:
              return "rgb(59,222,200)";
              break;
          default:
                return "primary";
              break;
      }
        },
        alldeleteItems(){
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
                  let form_data= new FormData();
                  let ids=JSON.stringify(this.selected_items)
                  form_data.append("ids",ids);
                axios.post("/management/remove-all/roles",form_data).then((res) => {
                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                      this.getRoles();

                  }).catch((err)=>{
                        this.$root.alertNotificationMessage(err.response.status,err.response.data);
                   //    console.log("erro",err.response.data.message);

                  });
              }
            });
        },
        selectAllItems(){

         if(this.selected_items.length>0)
         {
             this.selected_items=[];
         }
         else {
              this.selected_items=this.roles.data.map(x=>x.id);
         }
        },
        deleteItem: function (item) {
        return this.$emit("deleteItem", item);
        },
        editItem: function (item) {
            return this.$emit("editItem", item);
        }
    }
   }
</script>
<style>
.vs-avatar-content.btn-plane.vs-change-color-badge{
    margin-left: auto;
    position: relative;
    top: -30px;
}

</style>