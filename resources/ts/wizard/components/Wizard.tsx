import * as React from 'react'
import {FC, useState} from 'react'
import {Settings} from "../../sdk/Settings";
import StepOne from "./StepOne";
import StepTwo from "./StepTwo";
import StepThree from "./StepThree";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Form from "react-bootstrap/Form";
import {v4 as uuidv4} from 'uuid';

interface WizardProps {
    settings: Settings
}

export interface WizardData {
    province: string;
    dateStart: string;
    dateStop: string;
    email: string;
    letters: string[];
    uuid: string;
}

const Wizard: FC<WizardProps> = ({settings}: WizardProps) => {
    const [step, setStep] = useState(1)
    const [data, setData] = useState({province: '', email: '', letters: [], uuid: uuidv4()} as WizardData)

    const handleForward = () => {
        if (step < 3) {
            setStep(step => step + 1)
        }
    }
    const handleBackward = () => {
        if (step > 1) {
            setStep(step => step - 1)
        }
    }
    const handleSubmit = (e) => {
        e.preventDefault()
        e.stopPropagation()
        return false
    }

    return (
        <Container>
            <Row>
                <Col>
                    <Form onSubmit={handleSubmit}>
                        <StepOne
                            minDate={settings.dateRangeStart}
                            maxDate={settings.dateRangeStop}
                            visible={step === 1}
                            onForward={handleForward}
                            onBackward={handleBackward}
                            data={data}
                            setData={setData}
                        />
                        <StepTwo
                            minLettersCount={settings.keyLettersFrom}
                            maxLettersCount={settings.keyLettersTo}
                            visible={step === 2}
                            onForward={handleForward}
                            onBackward={handleBackward}
                            data={data}
                            setData={setData}
                        />
                        <StepThree
                            minLettersCount={settings.keyLettersFrom}
                            maxLettersCount={settings.keyLettersTo}
                            visible={step === 3}
                            data={data}
                            onForward={handleForward}
                            onBackward={handleBackward}
                        />
                    </Form>
                </Col>
            </Row>
        </Container>
    )
}

export default Wizard
