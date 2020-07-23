import * as React from 'react'
import * as ReactDOM from 'react-dom'
import axios from 'axios'
import 'bootstrap/dist/css/bootstrap.min.css'
import Wizard from "./wizard/components/Wizard";
import Endpoints from "./sdk/endpoints";
import SettingsFactory from "./sdk/Settings";

const appContainer = document.getElementById('app-container')

if (appContainer) {
    axios.get(Endpoints.settings()).then(settingsResponse => {
        const settings = SettingsFactory.make(settingsResponse.data)

        ReactDOM.render(<Wizard settings={settings}/>, appContainer)
    }).catch(reason => process.stdout.write('ERROR: ' + reason))
}
