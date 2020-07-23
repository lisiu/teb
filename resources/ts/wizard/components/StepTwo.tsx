import * as React from 'react'
import {FC} from 'react'
import Step from "./Step";
import StepForward from "./StepForward";
import StepBackward from "./StepBackward";
import Card from "react-bootstrap/Card";

interface Props extends Step {
    visible: boolean;
}

const StepTwo: FC<Props> = ({visible, onForward, onBackward}: Props) => {
    const handleForward = () => {
        onForward()
    }
    const handleBackward = () => {
        onBackward()
    }

    if (!visible) {
        return null
    }
    return (
        <Card bg="light">
            <Card.Header as="h5">Krok 2/3</Card.Header>
            <Card.Body>
                <StepForward disabled={false} onClick={handleForward}/>
                <StepBackward onClick={handleBackward}/>
            </Card.Body>
        </Card>
    )
}

export default StepTwo
