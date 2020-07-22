import * as React from 'react'
import * as ReactDOM from 'react-dom'

const appContainer = document.getElementById('app-container')

if (appContainer) {
    ReactDOM.render(<div>Hello React</div>, appContainer)
}
