/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
 /**
 * Uncomment below when compiling to production
 */
Vue.config.devtools = true
Vue.config.debug = true
Vue.config.silent = true

Vue.component('example', require('./components/Example.vue'));
Vue.component('welcome', require('./components/Welcome.vue'));
Vue.component('store', require('./components/FrontOffice.vue'));
Vue.component('office', require('./components/Office.vue'));
Vue.component('buyer-active', require('./components/BuyerActive.vue'));
Vue.component('seller-request', require('./components/SellerRequest.vue'));
Vue.component('items', require('./components/Items.vue'));
Vue.component('loader', require('./components/Loader.vue'));
Vue.component('product', require('./components/Product.vue'));
Vue.component('buy-item', require('./components/BuyItem.vue'));
Vue.component('seller-chat', require('./components/seller-chat.vue'));
Vue.component('buyer-chat', require('./components/buyer-chat.vue'));
Vue.component('sell-button', require('./components/SellButton.vue'));
Vue.component('products', require('./components/ActiveProduct.vue'));
Vue.component('chat-body', require('./components/ChatBody.vue'));
Vue.component('seller-not', require('./components/SellerNotifications.vue'));
Vue.component('buyer-not', require('./components/buyerNotifications.vue'));
Vue.component('buyer-pending', require('./components/BuyerPending.vue'));
Vue.component('buyer-loader', require('./components/BuyerLoader.vue'));
Vue.component('partner', require('./components/partner.vue'));
Vue.component('delete-product', require('./components/deleteProduct.vue'));
Vue.component('user', require('./components/user.vue'));
Vue.component('user-profile', require('./components/userProfile.vue'));

var algoliasearch = require('algoliasearch');
var client = algoliasearch('Y3X815DU84', 'a0ed93769dde50d9d3c34cfb692668a1');
var productIndex = client.initIndex('products');
var storeIndex = client.initIndex('stores');
import { store } from './store'

const app = new Vue({
    el: '#app',
	store,

	data() {
		
		return {
		
				content: '',
				not_working: true,
				attachment: false,
				form: new FormData,
				uploadedFile: [],
				uploadDelay: [],
				productImage: [],
				sendingPost: false,
				show_post_spinner:false,
				productName: '',
				ocategory: "",
				ncategory: "",
				pdisabled: true,
				categories: [],
				products: [],
				productPrice: "",
				productLocation: "",
				sellerEmail: '',
				sellerImage: [],
				adminEmail: '',
				sdisabled:true,
				store: [],
				similar: [],
				query:'',
				results: [],
				activeSellers: [],
				activeProduct: [],
				activeProductId: '',
				activeSellerId: '',
				activeCategoryId: '',
				activeChat: [],
				activeTransaction: [],
				openTransactions: [],
				closedTransactions: [],
				showTransaction:false,
				authDetails: [],
				typedChat:'',
				showOpenTransactions: '',
				openNewShop: false,
				addNewCategory: false,
				shopName:'',
				shopLocation:'',
				authShops: [],
				activeShop: '',
				pdescription:'',
				appOn: true,
				start: 0,
				trigger: 0,
				allShops: [],
				pendingTrackers: [],
				buyerActiveTrackers: [],
				sellerRequestTrackers: [],
				sellerChatTrackers: [],
				buyerChatTrackers: [],
				productAndStoreQuery: "",
				locationQuery: "",
				storesFound: [],
				productsFound: [],
				sampleStores:[],
				noResult: false,
				place: "Everywhere",
				onlineShops: [],
				again: 0,
				newShops: [],
				ulga: "",
				ustate: "",
				showSaving: false,
				showSaved: false,
				catType: 1,
				searchedLocation: "",
				searchedProduct: "",
				productResults: [],
				locationResults: [],
				productSuggest: false,
				locationSuggest: false,
				locationMainResults:[],
				productMainResults:[],
				mainSearchResult:[],
				showSpinnerModal:false,
				partnerProduct:0,
				categoryName:"",
				categoryType:0,
				cdisabled:true,
				services:[],
				authProducts:[],
				authServices:[],
				targetProduct:"",
				regName:"",
				regEmail:"",
				regPhone:"",
				regPass:"",
				regConfirm:"",
				logEmail:"",
				logPass:"",
				log:false,
				reg:false,
		}
		
		
		
	},
	
mounted() {	
this.getLocation()	
this.getBuyerChat()
this.getSellerChat()
this.getSellerRequests()
this.getBuyerPendingTransactions()
this.getBuyerActiveTransactions()
this.getSellerActiveTransactions()
this.getBuyerChats()
this.getSellerChats()
this.getPendingTrackers()
this.getBuyerActive()	
this.scroller()	
this.allCategories()
this.allProducts()
this.allServices()
this.getAuthDetails()
this.getAuthShops()
this.getAllShops()
this.getAuthProducts()
this.getAuthServices()	
},
	
methods: {
	
regUser() {

let data = JSON.stringify({
        name: this.regName,
        email: this.regEmail,
		phone: this.regPhone,
		password: this.regPass,
		password_confirmation: this.regConfirm
    })
	
axios.post('/register/login/register', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				console.log("done")
				this.getAuthDetails();
				this.callPartner(this.targetProduct)
				
				})
	
},

logUser() {

let data = JSON.stringify({
      
        email: this.logEmail,
		password: this.logPass,
    })
	
axios.post('/login/seller/login', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				console.log("done")
				this.getAuthDetails();
				this.callPartner(this.targetProduct)
				
				})
	
},

adminDeleteProduct(pid){
	
	var product = this.products.find ( p => {
				return p.id === pid
				
			});
			
			
			var index = this.products.indexOf(product)
			
			this.products.splice(index, 1)
	
	axios.get('/admin/delete/product/' + pid).then(response=>{

		
	})
	
},

adminDeleteService(pid){
	
	var product = this.services.find ( p => {
				return p.id === pid
				
			});
			
			
			var index = this.services.indexOf(product)
			
			this.services.splice(index, 1)
	
	axios.get('/admin/delete/product/' + pid).then(response=>{

		
	})
	
},


authDeleteProduct(pid){
	
	var product = this.authProducts.find ( p => {
				return p.id === pid
				
			});
			
			
			var index = this.authProducts.indexOf(product)
			
			this.authProducts.splice(index, 1)
	
	axios.get('/auth/delete/product/' + pid).then(response=>{

		
	})
	
},

authDeleteService(pid){
	
	var product = this.authServices.find ( p => {
				return p.id === pid
				
			});
			
			
			var index = this.authServices.indexOf(product)
			
			this.authServices.splice(index, 1)
	
	axios.get('/auth/delete/product/' + pid).then(response=>{

		
	})
	
},


adminDeleteCategory(cid){
	
	var category = this.categories.find ( c => {
				return c.id === cid
				
			});
			
			
			var index = this.categories.indexOf(category)
			
			this.categories.splice(index, 1)
	
	axios.get('/admin/delete/category/' + cid).then(response=>{

		
	})
	
},

showLogin() {
var shadow = document.getElementById('shadow')	
var login = document.getElementById('login-form-holder')
var register = document.getElementById('register-form-holder')
document.body.scrollTop = 0; // For Safari
document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
shadow.classList.remove('hidden')		
login.classList.remove('hidden')	
register.classList.add('hidden')		
},

showRegister() {
var shadow = document.getElementById('shadow')
var register = document.getElementById('register-form-holder')
var login = document.getElementById('login-form-holder')
document.body.scrollTop = 0; // For Safari
document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
shadow.classList.remove('hidden')		
register.classList.remove('hidden')	
login.classList.add('hidden')		
},
	
callPartner(pid) {
		
this.targetProduct=pid
if (this.authDetails[0].length==0) {

this.showLogin()
return	
}

shadow.classList.remove('hidden')

this.partnerProduct= pid;	


axios.get('/start/transaction/' + pid).then(response=>{
		
		
		this.activeTransaction= []
		console.log(response.data)

	})	
	
	
},

removeContact() {
this.$store.commit('cancel_transaction')
var shadow = document.getElementById('shadow')
shadow.classList.add('hidden')
this.partnerProduct= 0;	
	
	
},
	
pushProduct(p) {
this.productSuggest=false
this.locationSuggest=false

this.searchedProduct= p;	
	
this.startSearch()	
},

pushLocation(l) {

this.productSuggest=false
this.locationSuggest=false

this.searchedLocation= l;	
	
this.startSearch()	
},


	
findProducts() {

this.productSuggest=true
this.locationSuggest=false
	
this.productResults=[]
this.mainSearchResult=[]
if (this.searchedProduct.length==0) {

return	
	
}
	
productIndex.search(this.searchedProduct, (err, product) => {

this.productResults=[]
	product.hits.forEach((product) => {
	
	var verify = this.productResults.find ( p => {
				return p.name === product.name
				
			})

		if(!verify) {
		
		this.productResults.push (product)
		
		
		}
	
	});		
	
});
	
},

findLocations() {

this.productSuggest=false
this.locationSuggest=true
this.mainSearchResult=[]
this.locationResults=[]

if (this.searchedLocation.length==0) {

return	
	
}

productIndex.search(this.searchedLocation, (err, location) => {

this.locationResults=[]
	location.hits.forEach((location) => {
	
	var verify = this.locationResults.find ( l => {
				return l.location === location.location
				
			})

		if(!verify) {
		
		this.locationResults.push (location)
		
		
		}
	
	});	
	
});
	
},

hideSpinner() {

this.showSpinnerModal=false	
	
},

startSearch() {
this.showSpinnerModal=true	
this.initSearch()
this.initSearch()
	
setTimeout(this.initSearch, 3000)

	
},

initSearch() {
this.productSearchModal()	
this.prepareSearch() 
this.showSpinnerModal=true
this.mainSearchResult=[]

if	(this.searchedProduct.length==0 && this.searchedLocation.length>0) {
	this.mainSearchResult=[];
	this.mainSearchResult=this.locationMainResults	
	return
}

this.productMainResults.forEach((product) => {


if	(this.searchedLocation.length==0) {
	this.mainSearchResult=[];
	this.mainSearchResult.push(product)	
	
} else {
var verify = this.locationMainResults.find ( l => {
				return l.id === product.id
				
			});	
	
	if(verify) {
		

	this.mainSearchResult.push(product)	
		
	}
}
});


if(this.searchedLocation.length==0 && this.searchedProduct.length==0 ) {

this.mainSearchResult=[]

}	
	
},

prepareSearch(){



if(this.searchedLocation.length>0){
	
productIndex.search(this.searchedLocation, (err, location) => {
	this.locationMainResults=[]
	location.hits.forEach((location) => {
	
	var verify = this.locationMainResults.find ( l => {
				return l.id === location.id
				
			})

		if(!verify) {
		
		this.locationMainResults.push (location)
		
		
		}
	
	});	
	

	
});


}

productIndex.search(this.searchedProduct, (err, product) => {

this.productMainResults=[]
	product.hits.forEach((product) => {
	
	var verify = this.productMainResults.find ( p => {
				return p.id === product.id
				
			})

		if(!verify) {
		
		this.productMainResults.push (product)
		
		
		}
	
	});		
	
});
	
if(this.searchedLocation.length==0 && this.searchedProduct.length==0 ) {

this.mainSearchResult=[]

}

},
	
showProductPage() {

if(this.catType=1){
this.productServicePage()
}		
	
},

showServicePage() {

if(this.catType=2) {
this.productServicePage()
} 
	
},

productServicePage() {

var toggle = document.getElementById("product-page")
	
 if(toggle.style.left !=0 + 'px') {
	 toggle.style.left=0 + 'px'
	 
 } else {
	 toggle.style.left=-2000 + 'px'
	
}

this.productImage = []
this.productName = ''
this.pdescription = ''
this.productLocation = ''
this.productPrice = ''
	
	
	
},


	
locationModal() {
	
	var toggle = document.getElementById("location-search")
	var modal = document.getElementById("modal-location-span")
 if(toggle.style.left !=0 + 'px') {
	 toggle.style.left=0 + 'px'
	 modal.style.top=3 + '%'
 } else {
	 toggle.style.left=-2000 + 'px'
	 modal.style.top=50 + '%'
}
	
	
},

productSearchModal() {
	
	var toggle = document.getElementById("product-search")
	
 if(toggle.style.left !=0 + 'px') {
	 toggle.style.left=0 + 'px'
	
 } else {
	 toggle.style.left=-2000 + 'px'
	 this.showSpinnerModal=false

	 
 }
},
	
toggleBar() {
 
 var x = document.getElementById("showmenu")
 x.classList.toggle("change")
 
 var toggle = document.getElementById("toggle-menu")
 
 if(toggle.style.top !=0 + 'px') {
	 toggle.style.top=0 + 'px'
	 
 } else {
	 toggle.style.top=-2000 + 'px'
}
	
	
},
	
queryLocation() {

this.onlineShops=[]

if(this.place.length==0) {

this.place= "Everywhere"


if(this.ustate.length>0) {

this.place= this.ustate

}
}
	
var location
if(this.place== "Everywhere") {
	var location= ' ' 	
} else {
	location= this.place;	
}

storeIndex.search(location, (err, store) => {
	this.onlineShops=[]
	store.hits.forEach((store) => {
	
	var verify = this.onlineShops.find ( s => {
				return s.id === store.id
				
			})

		if(!verify) {
		if(store.online==1) {
		this.onlineShops.push (store)
		}
		
		}
	
	});
	
	if(this.onlineShops.length==0) {
		this.place = 'Everywhere . No result for '+ this.place;
	}
	
	
});	




var everywhere = document.getElementById('everyWhere')
var input = document.getElementById('enterLocation')

if(everywhere && input) {
everywhere.classList.remove("hidden")
input.classList.add("hidden")	
}	
},
	
changeLocation(){
if (this.place.length==0 || this.place.length>19) {
this.place = "Everywhere"


if (this.ustate.length>0) {
this.place = this.ustate
}

}

var everywhere = document.getElementById('everyWhere')
var input = document.getElementById('enterLocation')

everywhere.classList.add("hidden")
input.classList.remove("hidden")
},

clearSearch() {
this.storesFound=[]
this.productsFound=[]
this.sampleStores=[]
this.again= 0
this.noResult= false
},	
	
getSearchQuery() {

var noresult = document.getElementById('noResult')
var result = document.getElementById('searchResult')
noresult.classList.remove("hidden")
result.classList.remove("hidden")

if(this.productAndStoreQuery.length==0){return}

var searchLocation
if (this.locationQuery.length>0) {
	searchLocation= this.locationQuery
} else {
	searchLocation=" "
	
}

productIndex.search(this.productAndStoreQuery, (err, product) => {
	
	if(product.hits.length>0) {
	product.hits.forEach((product) => {
	
	var verify = this.productsFound.find ( p => {
				return p.id === product.id
				
			})

		if(!verify) {	
		this.productsFound.push (product)
		
		}
	
	})
	
	}
	
});


storeIndex.search(this.productAndStoreQuery, (err, store) => {
	
	if(store.hits.length>0) {
		
	store.hits.forEach((store) => {
	
	var verify = this.sampleStores.find ( s => {
				return s.id === store.id
				
			})

		if(!verify) {
			
		this.sampleStores.push (store)
		
		}
	
	})
	
	}
	
});	


if (this.productsFound.length>0 || this.sampleStores.length>0){
storeIndex.search(searchLocation, (err, store) => {
	
	store.hits.forEach((store)=> {
		
		/* I am about to match products and stores I pushed
		to sampleStore and productsFound array to stores in user specified 
		location*/
		
		/* For every stores in the specified location I am checking to see 
		 if they have products I pushed to productsFound array if there is a match
		 I will push them to storesFound array which will display to users */
		if (this.productsFound.length>0) {
		this.productsFound.forEach((product)=> {
			
		if (product.store_id==store.id) {

		var verify = this.storesFound.find ( s => {
				return s.id === store.id
				
			})

		if(!verify) {	
		this.storesFound.push(store)
		
		}


		}		
			
		})
		}
		
		
		/* For every stores in the specified location I am checking to see 
		 if they maatch any store I pushed to sampleStore array, if there is a match
		 I will push them to storesFound array which will display to users */
		if(this.sampleStores.length>0) {
		this.sampleStores.forEach((sample)=> {
			
		if (sample.id==store.id) {

		var verify = this.storesFound.find ( s => {
				return s.id === store.id
				
			})

		if(!verify) {	
		this.storesFound.push(store)
		
		}


		}		
			
		})
		
		}
	 	
		
	})
	
	
	if (this.storesFound.length==0) {
		if(this.again==1) {
		this.noResult=true;
		}
		
	} else {
		
		this.noResult=false;
		
	}
	
});	

} else {
	
	if(this.again==1) {
		this.noResult=true;
		}
	
}


if(this.again==0) {

setTimeout(this.getSearchQuery, 1200)

this.again= 1
}


},
	
getSellerRequests() {


	
},

showMainSearch() {

var fake= document.getElementById("fake-search")
var original= document.getElementById("main-search")
fake.classList.add('hidden')
original.classList.remove('hidden')	


	
},
	
stopScroll() {

var bodyScroll= document.getElementsByTagName("body")[0].style.overflow="hidden"	
	
},

startScroll() {

var bodyScroll= document.getElementsByTagName("body")[0].style.overflow="auto"	
	
},
	
scroller() {
		
		 window.onscroll = event => {
			
			
			var d = document.documentElement;
			var offset = d.scrollTop + window.innerHeight;
			var height = d.scrollHeight - this.trigger;
			
		
			if (offset >= height) {
			
				  
                  this.start = this.start + 5
				  
				  this.getAllShops();
				  
				 
				  
				  
			   
		}
	}
	
},


getSellerRequests() {

axios.get('/get/request/trackers').then(response=>{
		
		response.data.forEach((tracker) => {
		this.sellerRequestTrackers.push(tracker)
		
		})
		 
	})	
	
	
},

getBuyerActive() {

axios.get('/get/buyer/active/trackers').then(response=>{
		
		response.data.forEach((tracker) => {
		this.buyerActiveTrackers.push(tracker)
		
		})
		 
	})	
	
	
},

getBuyerChat() {

axios.get('/get/buyer/chat/trackers').then(response=>{
		
		response.data.forEach((tracker) => {
		this.buyerChatTrackers.push(tracker)
		
		})
		 
	})	
	
	
},

getSellerChat() {

axios.get('/get/seller/chat/trackers').then(response=>{
		
		response.data.forEach((tracker) => {
		this.sellerChatTrackers.push(tracker)
		
		})
		 
	})	
	
	
},

getPendingTrackers(){
	
	axios.get('/get/pending/trackers').then(response=>{
		
		response.data.forEach((tracker) => {
		this.pendingTrackers.push(tracker)
		
		})
		 
	})
	
},


getBuyerPendingTransactions(){
	
	axios.get('/get/pending/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_pending_transactions', transactions)
		
		})
		 
	})
	
},

getBuyerActiveTransactions(){
	
	axios.get('/get/buyer/active/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_buyer_active_transactions', transactions)
		
		})
		 
	})
	
},

getSellerActiveTransactions(){
	
	axios.get('/get/seller/active/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_seller_active_transactions', transactions)
		
		})
		 
	})
	
},


getBuyerChats(){
	
	axios.get('/get/buyer/chats').then(response=>{
		
		response.data.forEach((chat) => {
		this.$store.commit('add_buyer_chats', chat)
		
		})
		 
	})
	
},

getSellerChats(){
	
	axios.get('/get/seller/chats').then(response=>{
		
		response.data.forEach((chat) => {
		this.$store.commit('add_seller_chats', chat)
		
		})
		 
	})
	
},

pendingUrl() {

window.location = "/buyers/pending/transactions";

},

viewProfile(pid) {

window.location = "/user/" + pid ;

},

publicLoginUrl() {

window.location = "/login";

},

publicRegisterUrl() {

window.location = "/register";

},


	
transactionsUrl() {

window.location = "/buyers/transactions";

},	

sellerTransactionsChatUrl(){
	
window.location = "/chat/sellers/chat";	
	
},

transactionsChatUrl(){
	
window.location = "/chat/transactions/";	
	
},

	
sellerTransactionsUrl() {

window.location = "/transactions/sellers/transactions";

},	
	
homeUrl() {

window.location = "/";

},

sellerHomeUrl() {

window.location = "/login/seller/login";

},

		
	
onApp() {

this.appOn = true


axios.get('/on/app').then(response=>{
		
		
	})
	
},

offApp() {

this.appOn = false

axios.get('/off/app').then(response=>{
		
		
	})		
	
},
	
addCategory() {
	
this.addNewCategory= true
	
},

hideAddCategory() {
	
this.addNewCategory= false
this.sendCategory()
	
},

openShop() {
	
this.openNewShop = true	
	
},

hideOpen() {
	
this.openNewShop = false

let data = JSON.stringify({
        name: this.shopName,
		location: this.shopLocation,
	
    })
				
				
				axios.post('/save/shop', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				
				
				this.shopLocation=''
				this.shopName=''
				this.getNewShops()
				
				
				})
	
	
},

getNewShops() {
	
	axios.get('/auth/shops').then(response=>{
		this.newShops= []
		response.data.forEach((shop) => {
		this.newShops.push(shop)
		
		})
	})
	
	
},

getAuthShops() {
	
	axios.get('/auth/shops').then(response=>{
		this.authShops= []
		response.data.forEach((shop) => {
		this.authShops.push(shop)
		this.newShops.push(shop)
		
		})
	})
	
	
},

sendTypedMessage(tid) {
	var sid
	if(this.activeChat[0].sender_id == this.authDetails.id) {
	sid = this.activeChat[0].receiver_id	
		
	} else {
		
		sid= this.activeChat[0].sender_id	
		
	}
	var body = this.typedChat
	let data = JSON.stringify({
        transaction: tid,
		receiver: sid,
        body: body,
	
    })
				
				
				axios.post('/send/chat', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				
				this.getChat(tid)
				this.typedChat=''
				
				
				})
	
	
},
getAuthDetails(){
	
	axios.get('/auth/details').then(response=>{
		
		if(response.data.online==0) {

        this.appOn = false

       }
		this.authDetails=[]
		this.authDetails.push(response.data)
	})
	
},


getAllShops(){
	
	axios.get('/get/all/shops/' + this.start).then(response=>{
		
		
		 response.data.forEach((shop) =>{

		if (this.allShops.length==0) {
		
        this.allShops.push(shop)		
		return 1	
			
		}
		
		var verify = this.allShops.find ( s => {
				return s.id === shop.id
				
			})

		if(!verify) {	
		this.allShops.push(shop)
		
		}
		 })
	})
	
},

showError(error) {
	
	this.queryLocation()

    switch(error.code) {
        case error.PERMISSION_DENIED:
            console.log("permision denied")
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("position unavailable")
            break;
        case error.TIMEOUT:
           console.log("Timeout")
            break;
        case error.UNKNOWN_ERROR:
           console.log("unknown")
            break;
    }
},
	
	
showPosition(position) {
	
	var latlng;
    var address;
    var geocoder = new google.maps.Geocoder();

  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  geocoder.geocode({'latLng': latlng}, (results, status) => {
    if (status == google.maps.GeocoderStatus.OK) {
		
      if (results[0]) {
		 this.ulga = results[1].address_components[1].long_name;
		 this.ustate = results[1].address_components[2].long_name;
         address = this.ulga + ', ' + this.ustate
        this.searchedLocation= address
		if(this.place = this.ustate) {
			
			this.queryLocation();
		}
		
      }else{
        error("Unable to reverse Geocode");
      }
    }
  });
 
},
	
getLocation() {
	
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.showPosition, this.showError);
    } else { 
        this.queryLocation()
    }
	
},



	
searchProducts() {
	if (!this.query.length) {
	return	
		
	}
	index.search(this.query, (err, content) => {
	
	this.results =content.hits
	
});
	
	
},


removeProduct(pid) {

axios.get('/remove/product/' + pid ).then(response=>{
		
		this.authStore();
		
		
		
});

},	
	
allProducts() {

axios.get('/all/products').then(response=>{
		
		this.products=[]
		response.data.forEach((product)=> {
			
		this.products.push(product)
			
		})
		
		
});

},

getAuthProducts() {

axios.get('/auth/products').then(response=>{
		
		this.authProducts=[]
		response.data.forEach((product)=> {
			
		this.authProducts.push(product)
			
		})
		
		
});

},


getAuthServices() {

axios.get('/auth/services').then(response=>{
		
		this.authServices=[]
		response.data.forEach((product)=> {
			
		this.authServices.push(product)
			
		})
		
		
});

},



allServices() {

axios.get('/all/services').then(response=>{
		
		this.services=[]
		response.data.forEach((service)=> {
			
		this.services.push(service)
			
		})
		
		
});

},

guestProducts() {

axios.get('guest/all/products').then(response=>{
		
		this.products=[]
		response.data.forEach((product)=> {
			
		this.products.push(product)
			
		})
		
		
});

},

	
allCategories() {

axios.get('/all/categories').then(response=>{
		
		this.categories = []
		response.data.forEach((category)=> {
			
		this.categories.push(category)
			
		})
		
		
});






},
		
sendCategory() {
if (this.ncategory.length==0) {	
	return
}

axios.get('/save/category/' + this.ncategory).then(response=>{
		
		this.categories = []
		response.data.forEach((category)=> {
			
		this.categories.push(category)
			
		})
		
		this.ncategory= ''
		
		
});


},



submitCategory() {
	
	if (this.productImage.length>0 && this.categoryType>0 && (this.categoryName.length>0)) {
			
		this.cdisabled= false
			
		} else {
	
	this.cdisabled= true
	return
	
	
}

this.showSaving= true;

let data = JSON.stringify({
        name: this.categoryName,
        image: this.productImage[0].URL,
		type: this.categoryType,
		
    })
				
				this.show_post_spinner=true
				
				axios.post('/submit/admin/category', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
					
					this.categoryName=""
					this.categoryType=0
					this.productImage = []
					this.productName = ''
					this.pdescription = ''
					this.productLocation = ''
					this.productPrice = ''
					this.show_post_spinner=false
					this.showSaved=true;
					this.allProducts();
					
					
					
					
					
				 
				})
			},



submitProduct() {
	
	if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productLocation.length>0) && (this.productName.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return
	
	
}

this.showSaving= true;

let data = JSON.stringify({
        name: this.productName,
        image: this.productImage[0].URL,
		description: this.pdescription,
		category: this.ocategory,
		price: this.productPrice,
		location: this.productLocation,
		type: 1,
		
    })
				
				this.show_post_spinner=true
				
				axios.post('/submit/product', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
					
					
					this.productImage = []
					this.productName = ''
					this.pdescription = ''
					this.productLocation = ''
					this.productPrice = ''
					this.show_post_spinner=false
					this.showSaved=true;
					this.allProducts();
					
					
					
					
				 
				})
			},
			
submitService() {
	
	if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productLocation.length>0) && (this.productName.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return
	
	
}

this.showSaving= true;

let data = JSON.stringify({
        name: this.productName,
        image: this.productImage[0].URL,
		description: this.pdescription,
		category: this.ocategory,
		price: this.productPrice,
		location: this.productLocation,
		type: 2,
		
    })
				
				this.show_post_spinner=true
				
				axios.post('/submit/product', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
					
					
					this.productImage = []
					this.productName = ''
					this.pdescription = ''
					this.productLocation = ''
					this.productPrice = ''
					this.show_post_spinner=false
					this.showSaved=true;
					this.allProducts();
					
					
					
					
				 
				})
			},
			
			
closeSaver() {

this.showSaving=false
this.showSaved=false	
	
},

findSeller(pid, cid){
		
		this.getActiveProduct(pid)
		this.activeProductId = pid
		this.activeCategoryId = cid

		axios.get('/find/sellers/' + pid + '/' +cid).then(response=>{
			this.activeSellers = []
			response.data.forEach((seller)=> {
			
		this.activeSellers.push(seller)
			
		})	
			
		})

		this.showActivePage()

},

getOpenTransactions() {
	
	
	this.showOpentansaction= false
	this.openTransactions= []
	axios.get('/open/transactions/').then(response=>{
	
		this.openTransactions = []
		response.data.reverse().forEach((transaction) => {
			
			this.openTransactions.push(transaction)
			
		})
		this.showOpenTransactions=true
	})
	
	
	
	
},


getClosedTransactions() {
	
	axios.get('/closed/transactions/').then(response=>{
		this.closedTransactions = []
		
		response.data.forEach((transaction) => {
			
			
			this.closedTransactions.push(transaction)
			
		})
		
	})
	
	
},


hireSeller(sid) {
	var cid
	if (this.activeCategoryId == 3) {
	cid = 3
	} else {
		
	cid = 0
	
	}
	
	axios.get('/create/transaction/' + sid + '/' + this.activeProductId + '/' + cid).then(response=>{
		
		this.activeTransaction= []
		this.activeTransaction.push(response.data)
		this.sendChat1(response.data.id, sid) 
		this.getOpenTransactions()

	})	
	
	this.hideActivePage()
	this.showChatBox()
	this.activeSellerId = sid
	
},

sendChat1(tid, sid) {
	
	var body = 'Hello there, trust you are doing great'
	let data = JSON.stringify({
        transaction: tid,
		receiver: sid,
        body: body,
	
    })
				
				
				axios.post('/send/chat', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				
				this.getChat(tid)
				
				this.sendChat2(tid, sid)
				
				
				})
	
	
},

sendChat2(tid, sid) {
	
		if (this.activeCategoryId == 3) {
		
		var body = 'How much will it cost me to hire you as my ' + this.activeProduct[0].name
		
	} else {
		
		
		var body = 'How much will it cost to buy ' + this.activeProduct[0].name + ' from you'
		
	}
	
	let data = JSON.stringify({
       transaction: tid,
		receiver:sid,
        body: body,
		
	
    })
				
				
				axios.post('/send/chat', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				
				this.getChat(tid)
				this.sendChat3(tid, sid)
				
				
				})
	
	
},




sendChat3(tid, sid) {
	
	if (this.activeCategoryId == 3) {
		
		var body = 'Let me know your transport fee and any other complementary services and their charges also, Thanks. '
		
	} else {
		
		
		var body = 'Let me know your delivery fee and any other complementary product you have and their cost also, Thanks. '
		
	}
	
	let data = JSON.stringify({
        transaction: tid,
		receiver: sid,
        body: body,
		
	
    })
				
				
				axios.post('/send/chat', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
				
				this.getChat(tid)
				
					
					
				})
				
				
	
	
},

declineTransaction(tid){
	
axios.get('/decline/transaction/' + tid).then(response=>{

this.getOpenTransactions();


})	
	
	
},

getChat(tid) {
	var container = document.getElementById('chatBody')
	container.scrollTop = container.scrollHeight
	this.showChatBox()
	axios.get('/get/chat/' + tid).then(response=>{
	          this.activeChat = []
			  
			  response.data.forEach((message) => {
			 this.activeChat.push(message)
			 
			 
		     container.scrollTop = container.scrollHeight
			 
			  })
			   

	});			
	
	
		
},


getActiveProduct(pid) {
	
	axios.get('/active/product/' + pid).then(response=>{
			
		
		this.activeProduct = []
		this.activeProduct.push(response.data)
			
		
			
		})
	
	
},
			
submitSeller() {
	
	if ((this.sellerEmail.length>0) && (this.sellerImage.length>0) && (this.adminEmail.length>0)) {
			
		this.sdisabled= false
			
		} else {
	
	this.sdisabled= true
	return
	
	
}

let data = JSON.stringify({
        email: this.sellerEmail,
        image: this.sellerImage[0].URL,
		admin: this.adminEmail
    })
				
				this.show_post_spinner=true
				
				axios.post('/submit/seller', data, {
					headers: {
						'Content-Type': 'application/json'
						
						}
						
					})
				.then( (response) => { 
					
					
					this.sellerImage = []
					this.sellerEmail = ''
					this.adminEmail = ''
					this.show_post_spinner=false
					
					
				 
				})
			},
			
			
//  Handling modal hiding and display methods			
		
showMenu() {

var bodyTop = document.getElementById('content-body')
var hiddenDiv = document.getElementById('hide')
var showmenu = document.getElementById('showmenu')
var hidemenu = document.getElementById('hidemenu')

bodyTop.style.top = 240 + 'px'
hiddenDiv.classList.remove('hidden')
showmenu.classList.add('hidden')
hidemenu.classList.remove('hidden')

},


hideMenu() {

this.startScroll()

var bodyTop = document.getElementById('content-body')
var hiddenDiv = document.getElementById('hide')
var hidemenu = document.getElementById('hidemenu')
var showmenu = document.getElementById('showmenu')

bodyTop.style.top = 80 + 'px'
hiddenDiv.classList.add('hidden')
showmenu.classList.remove('hidden')
hidemenu.classList.add('hidden')

},


verifyPassword() {
this.stopScroll()	
var searchModal = document.getElementById('search-page')	
searchModal.classList.remove('hidden')	
	
},

showSearchModal() {
this.stopScroll()
	
var searchModal = document.getElementById('search-page')	
searchModal.classList.remove('hidden')	
	
},

hideSearchModal() {
this.startScroll()
	
var searchModal = document.getElementById('search-page')	
searchModal.classList.add('hidden')	
	
},

showActivePage() {

this.stopScroll()	
var activeModal = document.getElementById('active-page')	
activeModal.classList.remove('hidden')	
	
},

hideActivePage() {
this.startScroll()
var activeModal = document.getElementById('active-page')	
activeModal.classList.add('hidden')	
	
},


loginFirst() {

this.stopScroll()
var loginFirst = document.getElementById('login-first')	
loginFirst.classList.remove('hidden')

},

hideLoginFirst() {
this.startScroll()
var loginFirst = document.getElementById('login-first')	
loginFirst.classList.add('hidden')

},



onProduct() {
	
var onproduct = document.getElementById('onproduct')
var offproduct = document.getElementById('offproduct')	

onproduct.classList.add('hidden')		
offproduct.classList.remove('hidden')	
},

offProduct() {
	
var onproduct = document.getElementById('onproduct')
var offproduct = document.getElementById('offproduct')	
offproduct.classList.add('hidden')
onproduct.classList.remove('hidden')		
	
},

showProductPrice() {

this.stopScroll()
	
var product = document.getElementById('product-price')

product.classList.remove('hidden')	
},

hideProductPrice() {
this.startScroll()
var product = document.getElementById('product-price')

product.classList.add('hidden')
		
	
},


showChatBox() {
this.stopScroll()
var showChat = document.getElementById('chat-box')	
showChat.classList.remove('hidden')

},

hideChatBox() {
this.startScroll()
var showChat = document.getElementById('chat-box')	
showChat.classList.add('hidden')

},

startSellingModal() {
this.stopScroll()	
var startSelling = document.getElementById('start-selling')	
startSelling.classList.remove('hidden')

},

hideStartSellingModal() {
this.startScroll()	
startSelling = document.getElementById('start-selling')	
startSelling.classList.add('hidden')

},

showRecoverForm() {
this.stopScroll()	
this.hideWelcomeLoginModal()
this.hideLoginFirst()	
var recoverForm = document.getElementById('recover-form')	
recoverForm.classList.remove('hidden')

},

hideRecoverForm() {
this.startScroll()	
var recoverForm = document.getElementById('recover-form')	
recoverForm.classList.add('hidden')

},


welcomeLoginModal() {
this.stopScroll()	
var welcomeLogin = document.getElementById('welcome-login')	
welcomeLogin.classList.remove('hidden')	
	
	
},


hideWelcomeLoginModal() {
this.startScroll()	
var welcomeLogin = document.getElementById('welcome-login')	
welcomeLogin.classList.add('hidden')	
	
	
},

welcomeRegisterModal() {
this.stopScroll()	
var welcomeLogin = document.getElementById('welcome-register')	
welcomeLogin.classList.remove('hidden')	
	
	
},


hideWelcomeRegisterModal() {
this.startScroll()	
var welcomeLogin = document.getElementById('welcome-register')	
welcomeLogin.classList.add('hidden')	
	
	
},

freeLanceModal() {
this.stopScroll()	
var freeLance = document.getElementById('freelance-delivery')	
freeLance.classList.remove('hidden')	

},

hideFreeLanceModal(){
this.startScroll()	
var freeLance = document.getElementById('freelance-delivery')	
freeLance.classList.add('hidden')	
},

displayAdminCategory() {
	
var adminCategory = document.getElementById('admin-category')	
adminCategory.classList.remove('hidden')	
	
	
},


hideAdminCategory() {
this.startScroll()	
var adminCategory = document.getElementById('admin-category')	
adminCategory.classList.add('hidden')	
	
	
},


displayAdminSeller() {
this.stopScroll()	
var adminSeller = document.getElementById('admin-seller')	
adminSeller.classList.remove('hidden')	
	
	
},



hideAdminSeller() {
this.startScroll()	
var adminSeller = document.getElementById('admin-seller')	
adminSeller.classList.add('hidden')	
	
	
},



//Handle Product Sales
authStore() {
	
	axios.get('/auth/store')
				.then( (response) => {
	this.store= []
	
	response.data.forEach((item) => {
	
    this.store.push(item)
	
	})

				})
	
	
},


		
		
// Handling Product Image Upload


showImagePicker() {
		
		this.$refs.image.click();
		
		},
		
showProductImagePicker() {
	var select = document.getElementById('productimage')	
		select.click();
		
		},

removeUploaded() {	
	this.productImage= [];				
},
		
imageChange(e) {
		
		let selected=e.target.files[0];
		
		if (!selected) {
		return 0
		}
		
		
		this.uploadDelay.push('File')
		
		
		
		let selectedFile=e.target.files[0];
		
		
		this.attachment=selectedFile;
		this.form.append('img', this.attachment);
		const config = {headers: {'Content-Type': 'multipart/form-data'}};
		
		axios.post('/upload/image', this.form, config).then(response=>{
		//success
		
		
			
			if (response.data.length == 0) {
			this.uploadDelay= [];
			
			return
			
			}
					
					this.productImage = [];
					this.uploadDelay= [];
					this.productImage.push(response.data);
					var container = document.getElementById('uploadedContainer')
	container.classList.remove('hidden')
				
				
		
		})
				.catch(response=>{
				//errors
				});
		
},



sellerImageChange(e) {
	
	
		
		let selected=e.target.files[0];
		
		if (!selected) {
		return 0
		}
		
		
		this.uploadDelay.push('File')
		
		
		
		let selectedFile=e.target.files[0];
		
		
		this.attachment=selectedFile;
		this.form.append('img', this.attachment);
		const config = {headers: {'Content-Type': 'multipart/form-data'}};
		
		axios.post('/upload/image', this.form, config).then(response=>{
		//success
		
		
			
			if (response.data.length == 0) {
			this.uploadDelay= [];
			
			return
			
			}
					
					this.sellerImage = [];
					this.uploadDelay= [];
					this.sellerImage.push(response.data);
				
				
		
		})
				.catch(response=>{
				//errors
				});
		
},


},
	
	
computed: {
	
	userDetails() {
				
	var details = this.$store.getters.all_user_details

	return details;
	},
	
	userProducts() {
				
	var products = this.$store.getters.all_user_products

	return products;
	},
	
	userServices() {
				
	var services = this.$store.getters.all_user_services

	return services;
	},
	
	
				
	pendingTrans() {
				
	var pending = this.$store.getters.all_pending_transactions

	return pending;
	},
	
	sellerActiveTrans() {
				
	var pending = this.$store.getters.all_seller_active_transactions

	return pending;
	},
	
	buyerActiveTrans() {
				
	var pending = this.$store.getters.all_buyer_active_transactions

	return pending;
	},
	
	sellerChats() {
				
   var pending = this.$store.getters.all_seller_chats

	return pending;
	},
	
	buyerChats() {
				
	var pending = this.$store.getters.all_buyer_chats

	return pending;
	}
			
},
	
watch: {
	
sellerImage() {

if ((this.sellerImage.length>0) && (this.sellerEmail.length>0 ) && (this.adminEmail.length>0)) {
			
		this.sdisabled= false
			
		} else {
	
	this.sdisabled= true
	return this.sdisabled
	
	
}

},

sellerEmail() {

if ((this.sellerImage.length>0) && (this.sellerEmail.length>0 ) && (this.adminEmail.length>0)) {
			
		this.sdisabled= false
			
		} else {
	
	this.sdisabled= true
	return this.sdisabled
	
	
}

},

adminEmail() {

if ((this.sellerImage.length>0) && (this.sellerEmail.length>0 ) && (this.adminEmail.length>0)) {
			
		this.sdisabled= false
			
		} else {
	
	this.sdisabled= true
	return this.sdisabled
	
	
}

},
	
productImage() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productName.length>0 && this.productLocation.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} 
		
else if (this.productImage.length>0 && this.categoryName.length>0  && this.categoryType>0) {
			
		this.cdisabled= false
			
		} else {
	
	this.cdisabled= true
	this.pdisabled= true
	return this.pdisabled
	
	
} 



},


ncategory() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.ncategory.length==0 && this.shopName.length==0 && this.shopLocation.length==0) && (this.productName.length>0) && (this.pdescription.length>0) && (this.activeShop>0)) {
			
		
			
		} else {
	

	
	
}

},


categoryType() {

if ((this.productImage.length>0) && (this.categoryName.length>0)  && this.categoryType>0) {
			
		this.cdisabled= false
			
		} else {
	
	this.cdisabled= true
	return this.cdisabled
	
	
}
},


categoryName() {

if ((this.productImage.length>0) && (this.categoryName.length>0)  && this.categoryType>0) {
			
		this.cdisabled= false
			
		} else {
	
	this.cdisabled= true
	return this.cdisabled
	
	
}
},


ocategory() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productName.length>0 && this.productLocation.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return this.pdisabled
	
	
}
},


activeShop() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.ncategory.length==0 && this.shopName.length==0 && this.shopLocation.length==0) && (this.productName.length>0) && (this.pdescription.length>0) && (this.activeShop>0)) {
			
				
		} else {
	
	
	
	
}
},

productName() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productName.length>0 && this.productLocation.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return this.pdisabled;
	
	
}

},

	productLocation() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productName.length>0 && this.productLocation.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return this.pdisabled;
	
	
}

},

productPrice() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productName.length>0 && this.productLocation.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return this.pdisabled;
	
	
}

},

pdescription() {

if ((this.productImage.length>0) && (this.ocategory.length>0 && this.productPrice>0 && this.productName.length>0 && this.productLocation.length>0) && (this.pdescription.length>0)) {
			
		this.pdisabled= false
			
		} else {
	
	this.pdisabled= true
	return this.pdisabled;
	
	
}

}
	
	
}
});
