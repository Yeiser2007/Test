import Api from '../../services/Api'

export default {
    chatSelected({ commit,state }, user) {
        let searchUserChat = state.chatsSelectedUsers.find(({ id }) => id === user.id)

        if (!searchUserChat) {
            Object.assign(user, { minimizeChat: false })
            commit('SET_USER_CHAT', user)
        }
    },
    closeChatUser({ commit }, user) {
        commit('CLOSE_CHAT', user)
    },
    joinChatChannel({ commit }){
        Echo.join('chat')
        .here(users => {
            commit('SET_USERS_ONLINE', users)
        })
        .joining(user => {
            commit('NEW_USER_ONLINE', user)
        })
        .leaving(user => {
            commit('REMOVE_USER_ONLINE', user)
        })
    },
    async listUsers({ commit }) {
        await Api.get('admin/users/list')
            .then(({ data }) => {
                commit('SET_USERS', data)
            })
            .catch(() => {
                commit('SET_USERS', [])
            })
    },
    openChatUser({ commit }, user) {
        commit('SET_USER_CHAT', user)
    }
}