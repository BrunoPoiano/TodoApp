<template>
    <div class="mensagem text-center text-capitalize pt-2">
        <h2>{{ mensagem }}</h2>
    </div>

    <div class="container text-capitalize boxshade">
        <br />
        <!-- Criar Afazer-->
        <div class="card card-body">
            <div class="row">
                <h3 class="text-center">Prioridade</h3>
                <div class="col" v-for="(p, index) in prioridade" :key="index">
                    <div class="form-check col-4">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            :value="p.id"
                            v-model="pid"
                            required
                        />
                        <label class="form-check-label" for="flexRadioDefault1">
                            <h3>{{ p.nome }}</h3>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Afazer"
                        v-model="afazer"
                        @keyup.enter="store"
                    />
                </div>
                <div class="col">
                    <button class="btn btn-success" @click="store">OK</button>
                </div>
            </div>
        </div>

        <!-- Exibir afazeres-->
        <h3 class="text-center">Afazeres</h3>

        <div
            class="card card-body"
            v-for="(af, index) in afazeres"
            :key="index"
            :class="
                af.prioridade == 1
                    ? 'text-danger'
                    : '' || af.prioridade == 2
                    ? 'text-warning'
                    : '' || af.prioridade == 3
                    ? 'text-primary'
                    : ''
            "
        >
            <div class="row">
                <div class="col-9">
                    <h4>{{ af.afazer }} - {{ af.nome }}</h4>
                </div>
                <div class="col-3">
                    <button class="btn btn-success" @click="concluido(af.id)">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-check-lg"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"
                            />
                        </svg>
                    </button>
                    <button class="btn btn-danger" @click="Apagar(af.id)">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-trash-fill"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <hr width="”25%”" align="”right”" />
        <h3 class="text-center">Concluidas</h3>

        <!-- Exibir afazeres finalizados-->
        <div
            class="card card-body text-secondary"
            v-for="(af, index) in afazeresfinalizados"
            :key="index"
        >
            <div class="row">
                <div class="col-9">
                    <h4>{{ af.afazer }}</h4>
                </div>
                <div class="col-3">
                    <button class="btn btn-danger" @click="Apagar(af.id)">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-trash-fill"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <br />
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
export default {
    setup() {
        const afazer = ref();
        const afazeres = ref([]);
        const afazeresfinalizados = ref([]);
        const prioridade = ref([]);
        const pid = ref();
        const mensagem = ref();
        let fd = new FormData();

        onMounted(() => {
            getPrioridade();
            getafazeres();
            getafazeresfinalizados();
        });

        const getPrioridade = () => {
            axios
                .get("todo/getprioridades")
                .then((resp) => {
                    prioridade.value = resp.data;
                })
                .catch(
                    (err) => (mensagem.value = "Erro ao exibir prioridades")
                );
        };

        const getafazeres = () => {
            axios.get("todo/getafazeres").then((resp) => {
                afazeres.value = resp.data;
            });
        };

        const getafazeresfinalizados = () => {
            axios.get("todo/getafazeresfinalizados").then((resp) => {
                afazeresfinalizados.value = resp.data;
            });
        };

        const store = () => {
            if (pid.value == undefined) {
                mensagem.value = "Escolha uma prioridade";
            } else if (afazer.value == undefined || afazer.value == "") {
                mensagem.value = "Digite um Afazer";
            } else {
                fd.append("prioridade", pid.value);
                fd.append("afazer", afazer.value);

                axios
                    .post("todo/store", fd)
                    .then((resp) => {
                        mensagem.value = resp.data;
                        afazer.value = "";
                        getafazeres();
                        getafazeresfinalizados();
                    })
                    .catch((error) => {
                        mensagem.value = "erro ao salvar";
                    });
            }
        };

        const concluido = (id) => {
            axios.put("todo/update/" + id).then((resp) => {
                if (resp.status == 200) {
                    getafazeres();
                    getafazeresfinalizados();
                    mensagem.value = "Afazer Finalizado!";
                } else {
                    mensagem.value = "Erro ao concluir afazer!";
                }
            });
        };

        const Apagar = (id) => {
            axios.delete("todo/delete/" + id).then((resp) => {
                if (resp.status == 200) {
                    getafazeres();
                    getafazeresfinalizados();
                    mensagem.value = "Afazer Deletado com Sucesso!";
                } else {
                    mensagem.value = "Erro ao deletar afazer!";
                }
            });
        };

        return {
            store,
            afazer,
            prioridade,
            pid,
            mensagem,
            afazeres,
            concluido,
            Apagar,
            afazeresfinalizados,
        };
    },
};
</script>

<style>
.container {
    margin-top: 3rem;
    max-width: 40rem;
    background: white;
}
.mensagem {
    margin-top: 2rem;
}
.boxshade {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    text-align: center;
}
</style>
