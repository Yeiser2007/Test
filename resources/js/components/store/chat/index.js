import state from './state'
import actions  from './actions'
import mutations from './mutations'

const chatStore = {
    namespaced: true,
    state,
    actions,
    mutations
}

export default chatStore