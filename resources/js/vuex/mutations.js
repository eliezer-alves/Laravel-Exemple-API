let mutations = {
    CREATE_ATIVIDADE(state, atividade) {
        state.atividades.push(atividade)
    },
    FETCH_ATIVIDADES(state, atividades) {
        return state.atividades = atividades
    },
    DELETE_ATIVIDADE(state, atividade) {
        console.log(atividade);
        let index = state.atividades.findIndex(item => item.id_atividade_comercial === atividade.id_atividade_comercial)
        state.atividades.splice(index, 1)
    }
}
export default mutations