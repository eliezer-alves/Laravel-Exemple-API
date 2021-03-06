import axios from 'axios';
import { API_URL, header, params, VIA_CEP } from '../config/api'

let actions = {
    async login({ commit }, cliente) {

        cliente.cnpj = await cliente.cnpj.replace(/[^\d]+/g, '');
        params.append('username', cliente.cnpj);
        params.append('password', cliente.senha);

        return await axios.post(`${API_URL}/oauth/token`, params, header)
            .then(res => {
                if (res.data.access_token) {
                    commit('UPDATE_TOKEN_DATA', res.data);
                    commit('LOGIN', cliente);
                    return res;
                }
            }).catch(err => {
                if (err.response.data)
                    commit('ERRORS', err.response.data);
                // console.log('error', Object.assign({}, err));

            })
    },
    createAtividade({ commit }, atividade) {
        return axios.post(`${API_URL}/api/atividade_comercial`, atividade)
            .then(res => {
                commit('CREATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('ERRORS', err.response.data.errors)
            })
    },
    fetchAtividades({ commit }) {
        return axios.get(`${API_URL}/api/atividade_comercial`)
            .then(res => {
                commit('FETCH_ATIVIDADES', res.data)
            }).catch(err => {
                commit('ERRORS', err.response.data.errors)
            })
    },
    updateAtividade({ commit }, atividade) {
        return axios.put(`${API_URL}/api/atividade_comercial/${atividade.id_atividade_comercial}`, { ...atividade })
            .then(res => {
                console.log(res);
                commit('UPDATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('ERRORS', err.response.data.errors)
            })
    },
    deleteAtividade({ commit }, atividade) {
        return axios.delete(`${API_URL}/api/atividade_comercial/${atividade.id_atividade_comercial}`)
            .then(res => {
                if (res.status === 200)
                    commit('DELETE_ATIVIDADE', atividade)
            }).catch(err => {
                commit('ERRORS', err.response.data.errors)
            })
    },
    async createCliente({ commit }, cliente) {
        return axios.post(`${API_URL}/api/cliente`, cliente)
            .then(res => {
                if (res.status === 201) {
                    commit('ERRORS', [])
                    commit('SET_EMPTY_CLIENTE', {})
                }
                return res;
            }).catch(err => {
                // console.log('error', Object.assign({}, err));
                if (err.response.data.errors)
                    commit('ERRORS', err.response.data.errors)
            })
    },
    async getViaCep({ }, cep) {
        cep = cep.replace(/[^\d]+/g, '');
        const dadosEndereco = await axios.get(`${VIA_CEP}/${cep}/json`);
        return dadosEndereco.data;
    },

    fetchDominios({ commit }) {
        return axios.get(`${API_URL}/api/dominios`)
            .then(res => {
                commit('FETCH_DOMINIO', res.data)
            }).catch(err => {
                commit('ERRORS', err.response.data.errors)
            })
    },

}

export default actions
