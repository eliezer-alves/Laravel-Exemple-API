import { updateField } from 'vuex-map-fields';

let mutations = {
    updateField,
    CREATE_ATIVIDADE(state, payload) {
        state.atividades.push(payload)
    },
    FETCH_ATIVIDADES(state, payload) {
        return state.atividades = payload
    },
    UPDATE_ATIVIDADE(state, payload) {
        const { id_atividade_comercial, descricao } = payload;
        const index = state.atividades.findIndex(item => item.id_atividade_comercial === id_atividade_comercial);
        console.log(payload);
        state.atividades[index].descricao = descricao;
    },
    DELETE_ATIVIDADE(state, atividade) {
        let index = state.atividades.findIndex(item => item.id_atividade_comercial === atividade.id_atividade_comercial);
        state.atividades.splice(index, 1)
    },
    GET_ERRORS(state, payload) {
        state.errors = payload;
    },
    
}
export default mutations