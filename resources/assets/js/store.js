import Vuex from 'vuex'
import Vue from 'vue'


Vue.use(Vuex)

export const store = new  Vuex.Store ({
	state: {
		new_nots: [],
		pendingTransactions: [],
		
	},
	
	getters: {
		all_pending_transactions(state) {
			return state.pendingTransactions
		},
		all_nots(state) {
			return state.all_nots
		},
		
		all_posts(state) {
			return state.posts
		},
		
		all_friends(state) {
			return state.friends
		},
		
		all_profile_feed(state) {
			return state.profile_feeds
		},
		
		all_uploads(state) {
			return state.uploads
		},
		
		all_new_posts(state) {
			return state.new_posts
		},
		
	},
	
	mutations: {
		add_pending_transactions(state, transactions) {
			
			var verify = state.pendingTransactions.find ( p => {
				return p.id === transactions.id
				
			})
			if (!verify) {
			state.pendingTransactions.push(transactions)
			}
		},
		
		add_all_not(state, not) {
			
			var verify = state.all_nots.find ( n => {
				return n.id === not.id
				
			})
			if (!verify) {
			state.all_nots.push(not)
			}
		},
		
		clear_not_count(state) {
			state.notscount= []
		},
		
		add_upload(state, upload) {
			state.uploads.push(upload)
		},
		
		add_post(state, post) {
			
		var verify = state.posts.find ( p => {
				return p.id === post.id
					
				
				
			})
			
			
			if(!verify){
			state.posts.push(post)
			
			}
		
			
			
			
		},
		
		add_friend(state, friend) {
			
		var verify = state.friends.find ( f => {
				return f.id === friend.id
					
				
				
			})
			
			
			if(!verify){
			state.friends.push(friend)
			
			}
		
			
			
			
		},
		
		add_profile_feed(state, feed) {
			
		var verify = state.profile_feeds.find ( f => {
				return f.id === feed.id
					
				
				
			})
			
			
			if(!verify){
			state.profile_feeds.push(feed)
			
			}
		
			
			
			
		},
		
		add_new_post(state, post) {
			
		var verify = state.new_posts.find ( p => {
				return p.id === post.id
					
				
				
			})
			
			
			if(!verify){
			state.new_posts.push(post)
			
			}
		
			
			state.uploads = []
			
		},
		
		
		
		auth_user_data(state, user) {
			state.auth_user = user
		},
		
		update_post_likes(state, payload) 
		{
			var post = state.posts.find ( p => {
				return p.id === payload.id
				
			})
			
			post.likes.push(payload.like)
		},
		
		update_video_id(state, payload) 
		{
			state.videoid=[]
			
			state.videoid.push(payload.vid)
		},
		
		add_old_post_comment(state, comment) 
		{
			var post = state.posts.find ( p => {
				return p.id === comment.post_id
				
			})
			
			post.comments.push(comment)
		},
		
		add_new_post_comment(state, comment) 
		{
			var post = state.new_posts.find ( p => {
				return p.id === comment.post_id
				
			})
			
			post.comments.push(comment)
		},
		
		unlike_post(state, payload) 
		{
			var post = state.posts.find ( p => {
				return p.id === payload.post_id
				
			})
			
			var like = post.likes.find ( l => {
				return l.user_id === payload.user_id
				
			})
			
			var index = post.likes.indexOf(like)
			
			post.likes.splice(index, 1)
			
		},
		
		remove_uploaded(state, payload)
		{
			var uploaded = state.uploads.find ( u => {
				return u.URL === payload.filelink
				
			})
			var index = state.uploads.indexOf(uploaded)
			
			
			state.uploads.splice(index, 1)
			
			
		}
	},
	
	actions: {
		
	}

	
})