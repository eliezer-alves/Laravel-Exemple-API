import { updateField } from 'vuex-map-fields';
import addSeconds from "date-fns/addSeconds";


let mutations = {
    updateField,
    LOGIN(state, payload) {
        state.usuario.cnpj = payload.cnpj;
        state.usuario.senha = payload.senha;
    },
    UPDATE_TOKEN_DATA(state, payload) {
        localStorage.setItem("access_token", payload.access_token || payload.accessToken); //sometimes tokens are in snake case and other times they are in camelcase :/
        state.accessToken = localStorage.getItem("access_token");

        const tokensExpiry = addSeconds(new Date(), payload.expires_in || payload.expiresIn);
        state.tokensExpiry = tokensExpiry;
        localStorage.setItem("tokens_expiry", tokensExpiry);
    },
    DELETE_TOKEN_DATA(state) {
        state.accessToken = ''
        localStorage.removeItem("access_token");

        state.tokensExpiry = '';
        localStorage.removeItem("tokens_expiry");
    },
    SHOW_MODAL(state, payload) {
        state.showModal = payload;
    },
    ERRORS(state, payload) {
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
    SET_EMPTY_CLIENTE(state) {
        Object.assign(state.cliente, state.clienteDefault)
    },
    SET_DOC_FILES(state, payload) {
        state.solicitacao.docs.push(payload);
    },
    UNSET_DOC_FILES(state, payload) {
        console.log(state.solicitacao.docs);
        let kDoc = payload.kDoc;
        kDoc--;

        console.log(kDoc);
        state.solicitacao.docs.splice(kDoc, 1);

        console.log(state.solicitacao.docs);
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