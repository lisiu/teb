import * as React from 'react'
import {FC} from 'react'
import Step from "./Step";
import StepBackward from "./StepBackward";
import Card from "react-bootstrap/Card";
import StepForward from "./StepForward";

interface Props extends Step {
    visible: boolean;
}

const StepThree: FC<Props> = ({visible, onBackward}: Props) => {
    const handleBackward = () => {
        onBackward()
    }

    if (!visible) {
        return null
    }
    return (
        <Card bg="light">
            <Card.Header as="h5">Krok 3/3</Card.Header>
            <Card.Body>
                <StepBackward onClick={handleBackward}/>
            </Card.Body>
        </Card>
    )
}

export default StepThree
