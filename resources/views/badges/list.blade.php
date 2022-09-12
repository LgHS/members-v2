<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Badges
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <form>
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">UUID RFID</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control is-expanded">
                                        <input class="input" type="text" name="uuid" placeholder="UUID" disabled value="{{ $badge->uuid ?? '' }}">
                                    </div>
                                    Attention, si vous regénérez votre UUID, l'intégralité de vos badges seront désactivés. Vous devrez les flasher à nouveau. N'utilisez cette fonction que dans le cas d'une perte de badge.<br/>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox">
                                            <input type="checkbox" required>
                                            J'ai compris
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-danger" type="submit">
                                            Regénérer un nouvel UUID
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</x-layout>
