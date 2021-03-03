import axios from 'axios';
import { API_URL, header, params, VIA_CEP } from '../config/api'

let actions = {
    async login({ commit }, cliente) {

        cliente.username = await cliente.username.replace(/[^\d]+/g, '');
        console.log(cliente.username);

        params.append('username', cliente.username);
        params.append('password', cliente.password);

        return await axios.post(`${API_URL}/oauth/token`, params, header)
            .then(res => {
                if (res.status === 200)
                    // commit('CREATE_CLIENTE', cliente)
                    return res;
            }).catch(err => {
                commit('GET_ERRORS', err.response.data)
                // console.log(err.response.data.error);
                // console.log('error', Object.assign({}, err));

            })
    },
    createAtividade({ commit }, atividade) {
        return axios.post('http://localhost:8000/api/atividade_comercial', atividade)
            .then(res => {
                commit('CREATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    fetchAtividades({ commit }) {
        return axios.get('http://localhost:8000/api/atividade_comercial')
            .then(res => {
                commit('FETCH_ATIVIDADES', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    updateAtividade({ commit }, atividade) {
        return axios.put(`http://localhost:8000/api/atividade_comercial/${atividade.id_atividade_comercial}`, { ...atividade })
            .then(res => {
                console.log(res);
                commit('UPDATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    deleteAtividade({ commit }, atividade) {
        return axios.delete(`http://localhost:8000/api/atividade_comercial/${atividade.id_atividade_comercial}`)
            .then(res => {
                if (res.status === 200)
                    commit('DELETE_ATIVIDADE', atividade)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    async createCliente({ commit }, cliente) {
        console.log(cliente);
        cliente.cnpj = cliente.cnpj.replace(/[^\d]+/g, '');

        console.log(cliente);
        return axios.post(`http://localhost:8000/api/cliente`, cliente)
            .then(res => {
                if (res.status === 200)
                    commit('CREATE_CLIENTE', cliente)
                return res;
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },

    async getViaCep({ }, cep) {
        const dadosEndereco = await axios.get(`${VIA_CEP}/${cep}/json`);
        return dadosEndereco.data;
    },


    validaCPF({ }, value) {
        let Soma = 0;
        let Resto = 0;
        let isInvalid = false;

        for (let i = 1; i <= 9; i++)
            Soma = Soma + parseInt(value.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if (Resto == 10 || Resto == 11) Resto = 0;
        if (Resto != parseInt(value.substring(9, 10))) isInvalid = true;
        else isInvalid = false;

        Soma = 0;
        for (let i = 1; i <= 10; i++)
            Soma = Soma + parseInt(value.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if (Resto == 10 || Resto == 11) Resto = 0;
        if (Resto != parseInt(value.substring(10, 11))) isInvalid = true;
        else isInvalid = false;

        return isInvalid;
    }
}

export default actions
