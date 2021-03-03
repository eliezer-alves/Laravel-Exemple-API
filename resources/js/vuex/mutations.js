import { updateField } from 'vuex-map-fields';

let mutations = {
    updateField,
    LOGIN(state, payload) {

    },
    GET_ERRORS(state, payload) {
        state.errors = payload;
    },
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
    DELETE_ATIVIDADE(state, payload) {
        let index = state.atividades.findIndex(item => item.id_atividade_comercial === payload.id_atividade_comercial);
        state.atividades.splice(index, 1)
    },
    SET_DOC_FILES(state, payload) {
        let index = state.solicitacao.docs.findIndex(item => item.name == payload.name);
        if (index >= 0)
            state.solicitacao.docs.splice(index, 1)
        state.solicitacao.docs.push(payload);
    },
    UNSET_DOC_FILES(state) {
        state.solicitacao.docs.pop()
    },
    FETCH_DOMINIO(state, payload) {
        return state.dominios = payload
    },
    SET_SOLICITACAO(state, payload) {
        state.solicitacao = { ...payload, ...state.solicitacao };
    },
    SET_SOCIOS_SOLICITACAO(state, payload) {
        const { kSocio } = payload;
        const index = state.solicitacao.socios.findIndex(item => item.kSocio === kSocio);
        console.log(payload);
        console.log(index);
        if (index >= 0)
            state.solicitacao.socios[index] = { ...payload, ...state.solicitacao };
        else
            state.solicitacao.socios.push({ ...payload, ...state.solicitacao });
    }
}
export default mutations