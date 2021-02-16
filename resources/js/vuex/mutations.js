let mutations = {
    CREATE_ATIVIDADE(state, atividade) {
        state.atividades.unshift(atividade)
    },
    FETCH_ATIVIDADES(state, atividades) {
        return state.atividades = atividades
    },
    DELETE_ATIVIDADE(state, atividade) {
        let index = state.atividades.findIndex(item => item.id === atividade.id)
        state.atividades.splice(index, 1)
    }

}
export default mutations