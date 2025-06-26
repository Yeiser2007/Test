export default {
    NEW_USER_ONLINE(state, user) {
        let userState     = state.users.find(({ id }) => id === user.id)
        let indexUserChat = state.chatsSelectedUsers.findIndex(({ id }) => user.id === id)
        
        userState.loggedIn = true
        if (indexUserChat !== null) {
            let userChat = state.chatsSelectedUsers[indexUserChat]
            
            if (userChat)
                userChat.loggedIn = true
        }
    },
    CLOSE_CHAT(state, user) {
        let indexUser = state.chatsSelectedUsers.findIndex(({ id }) => user.id === id)
        
        state.chatsSelectedUsers.splice(indexUser,1)
    },
    MINIMIZE_CHAT(state, user) {
        let userChat = state.chatsSelectedUsers.find(({ id }) => user.id === id)

        userChat.minimizeChat = !userChat.minimizeChat
    },
    REMOVE_USER_ONLINE(state, userOffLine) {
        let userState = state.users.find(({ id }) => userOffLine.id === id)
        let userChat  = state.chatsSelectedUsers.find(({ id }) => userOffLine.id === id)
        
        userState.loggedIn = false
        if (userChat) {
            userChat.loggedIn = false
        }
    },
    SET_USER_CHAT(state, chat) {
        state.chatsSelectedUsers.push(chat)
    },
    SET_USER_LOGIN(state, { id,name }) {
        state.userLoggedIn = { id,name }
    },
    SET_USERS(state, users) {            
        state.users = users
    },
    SET_USERS_ONLINE(state, usersOnline) {
        state.users.forEach(user => {
            let userOnline = usersOnline.find(({ id }) => 
                (user.id == id) && (id !== state.userLoggedIn.id)
            )

            if (userOnline) {
                userOnline.loggedIn = true
            }
        })
    }
}